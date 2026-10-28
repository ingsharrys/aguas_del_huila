<?php

namespace Tests\Feature;

use App\Models\EncuestaPqrsdf;
use App\Models\PqrsdfRespuesta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SeguridadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Tablas del servidor que no tienen migración en el repositorio (esquema mínimo para pruebas)
        Schema::table('users', function ($t) {
            foreach (['username', 'estado', 'nombres', 'apellidos', 'numero_identificacion', 'tipo_vinculacion'] as $c) {
                $t->string($c)->nullable();
            }
            $t->date('fecha_terminacion')->nullable();
            $t->integer('area_id')->nullable();
            $t->integer('cargo_id')->nullable();
            $t->boolean('es_jefe')->default(false);
        });
        Schema::create('areas', fn ($t) => [$t->id(), $t->string('nombre'), $t->boolean('estado')->default(1), $t->integer('parent_id')->nullable(), $t->timestamps()]);
        Schema::create('cargos', fn ($t) => [$t->id(), $t->string('nombre'), $t->boolean('estado')->default(1), $t->timestamps()]);
        Schema::create('departamentos_col', fn ($t) => [$t->id(), $t->string('nombre')]);
        Schema::create('municipios_col', fn ($t) => [$t->id(), $t->integer('departamento_id'), $t->string('nombre'), $t->integer('estado')->default(1)]);
        Schema::create('encuesta_pqrsdf', function ($t) {
            $t->id();
            foreach (['apellido_usuario', 'asunto', 'codigo_radicado', 'correo_electronico', 'descripcion', 'direccion', 'direccion_mensajeria',
                'estado', 'fijo', 'identificado_anonimo', 'ip_address', 'motivo_cancelacion', 'movil', 'nombre_usuario', 'numero_identificacion',
                'otra_discapacidad', 'otro_pais', 'pais', 'razon_social', 'tipo_discapacidad', 'tipo_identificacion', 'tipo_pqrsf', 'tipo_respuesta', 'tipo_solicitante'] as $c) {
                $t->text($c)->nullable();
            }
            foreach (['area_id', 'asignado_por_id', 'cancelado_id', 'departamento_id', 'municipio_id', 'user_id', 'discapacidad', 'autoriza'] as $c) {
                $t->integer($c)->nullable();
            }
            foreach (['fecha_cancelacion', 'fecha_limite_respuesta', 'fecha_respuesta'] as $c) {
                $t->dateTime($c)->nullable();
            }
            $t->timestamps();
        });
        Schema::create('pqrsdf_archivos', fn ($t) => [$t->id(), $t->integer('pqrsdf_id'), $t->string('nombre_original')->nullable(), $t->string('nombre_archivo')->nullable(), $t->string('ruta'), $t->string('extension')->nullable(), $t->string('mime_type')->nullable(), $t->integer('tamano')->nullable(), $t->timestamps()]);
        Schema::create('pqrsdf_respuestas', function ($t) {
            $t->id();
            foreach (['tipo_respuesta', 'correo', 'direccion', 'empresa_encomienda', 'numero_guia', 'titulo_respuesta', 'texto_respuesta', 'observaciones'] as $c) {
                $t->text($c)->nullable();
            }
            foreach (['pqrsdf_id', 'usuario_id', 'estado', 'revisado_id'] as $c) {
                $t->integer($c)->nullable();
            }
            $t->dateTime('fecha_revision')->nullable();
            $t->timestamps();
        });
        Schema::create('cuestionarios_cacsp', fn ($t) => [$t->id(), $t->integer('municipio_id')->nullable(), $t->string('ubicacion')->nullable(), $t->integer('estrato')->nullable(), $t->string('sector')->nullable(), $t->string('nombre')->nullable(), $t->integer('edad')->nullable(), $t->string('sexo')->nullable(), $t->string('direccion')->nullable(), $t->string('barrio')->nullable(), $t->string('telefono')->nullable(), $t->date('fecha_encuesta')->nullable(), $t->timestamps()]);
        Schema::create('cuestionarios_cacsp_respuestas', fn ($t) => [$t->id(), $t->integer('cuestionario_id'), $t->string('pregunta_key'), $t->text('valor')->nullable(), $t->timestamps()]);
        Schema::create('encuesta_satisfaccion', function ($t) {
            $t->id();
            foreach (['nombre', 'correo', 'telefono', 'tramite', 'medio', 'informacion', 'facilidad', 'grupo', 'beneficio', 'costos'] as $c) {
                $t->text($c)->nullable();
            }
            $t->timestamps();
        });
        Schema::create('encuesta_evaluacion', function ($t) {
            $t->id();
            foreach (['actualizada', 'informacion', 'satisfaccion', 'facilidad'] as $c) {
                $t->text($c)->nullable();
            }
            $t->timestamps();
        });
        Schema::create('pqrsdf_documentos', fn ($t) => [$t->id(), $t->integer('respuesta_id'), $t->string('nombre_original')->nullable(), $t->string('ruta'), $t->timestamps()]);

        foreach (['Administrador', 'Editor', 'Extranet', 'Control Interno'] as $rol) {
            Role::create(['name' => $rol]);
        }

        DB::table('areas')->insert([['id' => 1, 'nombre' => 'Administrador'], ['id' => 2, 'nombre' => 'Comercial'], ['id' => 25, 'nombre' => 'Control Interno']]);
        DB::table('cargos')->insert(['id' => 1, 'nombre' => 'Profesional']);
        DB::table('departamentos_col')->insert(['id' => 41, 'nombre' => 'Huila']);
        DB::table('municipios_col')->insert(['id' => 1, 'departamento_id' => 41, 'nombre' => 'Neiva']);
    }

    private function usuario(string $rol, array $datos = []): User
    {
        static $n = 0;
        $n++;
        $u = User::create(array_merge([
            'name' => "U$n", 'username' => "u$n", 'email' => "u$n@test.co", 'password' => 'secreta123', 'estado' => 'Activado', 'area_id' => 2,
        ], $datos));
        $u->forceFill(['email_verified_at' => now(), 'es_jefe' => $datos['es_jefe'] ?? 0])->save();
        $u->assignRole($rol);

        return $u;
    }

    private function pqrs(array $datos = []): EncuestaPqrsdf
    {
        return EncuestaPqrsdf::forceCreate(array_merge(['codigo_radicado' => 'PQRSDF2026' . rand(100000, 999999), 'estado' => 'Asignada', 'area_id' => 2, 'identificado_anonimo' => 'identificado'], $datos));
    }

    // 1. Subida de imágenes
    public function test_upload_image_requiere_sesion(): void
    {
        $this->post('/upload-image', ['file' => UploadedFile::fake()->image('a.jpg')])->assertRedirect('/login');
    }

    public function test_upload_image_rechaza_php_y_acepta_imagen_con_nombre_aleatorio(): void
    {
        Storage::fake('public');
        $editor = $this->usuario('Editor');

        $php = UploadedFile::fake()->createWithContent('shell.php', "GIF89a<?php system(\$_GET['c']); ?>");
        $this->actingAs($editor)->postJson('/upload-image', ['file' => $php])->assertStatus(422);

        // Archivo real (no simulado) para que el tipo se detecte por contenido, como en producción
        $tmp = tempnam(sys_get_temp_dir(), 'pol');
        file_put_contents($tmp, "<?php echo 1; ?>");
        $poliglota = new UploadedFile($tmp, 'foto.php.jpg', null, null, true);
        $this->actingAs($editor)->postJson('/upload-image', ['file' => $poliglota])->assertStatus(422);

        $ok = $this->actingAs($editor)->postJson('/upload-image', ['file' => UploadedFile::fake()->image('Foto Mía.PNG')])->assertOk();
        $this->assertMatchesRegularExpression('#/storage/noticias/[0-9a-f-]{36}\.png$#', $ok->json('location'));
    }

    public function test_upload_image_prohibido_para_usuario_sin_rol(): void
    {
        $sinRol = User::create(['name' => 'x', 'username' => 'x', 'email' => 'x@x.co', 'password' => 'secreta123', 'estado' => 'Activado']);
        $sinRol->forceFill(['email_verified_at' => now()])->save();
        $this->actingAs($sinRol)->postJson('/upload-image', ['file' => UploadedFile::fake()->image('a.jpg')])->assertForbidden();
    }

    // 2. Escalamiento de privilegios
    public function test_editor_no_puede_crear_administrador(): void
    {
        $editor = $this->usuario('Editor');

        $this->actingAs($editor)->post('/dashboard/usuarios', [
            'nombres' => 'Mal', 'apellidos' => 'Actor', 'numero_identificacion' => '999', 'username' => 'malo', 'email' => 'malo@test.co',
            'password' => 'clave-larga-1', 'password_confirmation' => 'clave-larga-1', 'rol' => 'Administrador', 'area_id' => 2, 'cargo_id' => 1,
            'tipo_vinculacion' => 'Planta',
        ])->assertSessionHasErrors('rol');

        $this->assertDatabaseMissing('users', ['username' => 'malo']);
    }

    public function test_editor_no_puede_modificar_ni_borrar_administrador(): void
    {
        $editor = $this->usuario('Editor');
        $admin = $this->usuario('Administrador');

        $this->actingAs($editor)->get("/dashboard/usuarios/{$admin->id}/edit")->assertForbidden();
        $this->actingAs($editor)->put("/dashboard/usuarios/{$admin->id}", ['password' => 'x'])->assertForbidden();
        $this->actingAs($editor)->delete("/dashboard/usuarios/{$admin->id}")->assertForbidden();
    }

    public function test_administrador_si_puede_crear_administrador(): void
    {
        $admin = $this->usuario('Administrador');

        $this->actingAs($admin)->post('/dashboard/usuarios', [
            'nombres' => 'Nuevo', 'apellidos' => 'Admin', 'numero_identificacion' => '123', 'username' => 'nuevo', 'email' => 'nuevo@test.co',
            'password' => 'clave-larga-1', 'password_confirmation' => 'clave-larga-1', 'rol' => 'Administrador', 'area_id' => 2, 'cargo_id' => 1,
            'tipo_vinculacion' => 'Planta',
        ])->assertSessionHasNoErrors();

        $this->assertTrue(User::where('username', 'nuevo')->first()->hasRole('Administrador'));
    }

    public function test_areas_solo_administrador(): void
    {
        $this->actingAs($this->usuario('Editor'))->get('/dashboard/areas')->assertForbidden();
    }

    // 3. Permisos PQRSDF
    public function test_politica_pqrsdf(): void
    {
        $extranet = $this->usuario('Extranet');
        $jefe = $this->usuario('Extranet', ['es_jefe' => 1, 'area_id' => 2]);
        $control = $this->usuario('Control Interno', ['area_id' => 25]);
        $editor = $this->usuario('Editor');

        $ajena = $this->pqrs(['user_id' => 999, 'area_id' => 3]);
        $suya = $this->pqrs(['user_id' => $extranet->id]);
        $deArea = $this->pqrs(['user_id' => 999, 'area_id' => 2]);
        $deControl = $this->pqrs(['area_id' => 25]);

        $this->assertFalse(Gate::forUser($extranet)->allows('ver', $ajena));
        $this->assertTrue(Gate::forUser($extranet)->allows('ver', $suya));
        $this->assertFalse(Gate::forUser($extranet)->allows('ver', $deArea));
        $this->assertTrue(Gate::forUser($jefe)->allows('ver', $deArea));
        $this->assertFalse(Gate::forUser($jefe)->allows('ver', $ajena));

        $this->assertTrue(Gate::forUser($control)->allows('ver', $ajena));
        $this->assertFalse(Gate::forUser($control)->allows('gestionar', $ajena));
        $this->assertTrue(Gate::forUser($control)->allows('gestionar', $deControl));

        $this->assertFalse(Gate::forUser($editor)->allows('eliminar', $ajena));

        $propia = PqrsdfRespuesta::forceCreate(['pqrsdf_id' => $deArea->id, 'usuario_id' => $jefe->id, 'estado' => 1]);
        $otra = PqrsdfRespuesta::forceCreate(['pqrsdf_id' => $deArea->id, 'usuario_id' => $extranet->id, 'estado' => 1]);
        $this->assertTrue(Gate::forUser($jefe)->allows('aprobarRespuesta', [$deArea, $propia]), 'el jefe aprueba aunque la PQRSDF esté asignada a él');
        $this->assertTrue(Gate::forUser($jefe)->allows('aprobarRespuesta', [$deArea, $otra]));
        $this->assertFalse(Gate::forUser($extranet)->allows('aprobarRespuesta', [$suya, $otra]));
    }

    public function test_pqrsdf_acciones_http_bloqueadas(): void
    {
        $extranet = $this->usuario('Extranet');
        $control = $this->usuario('Control Interno', ['area_id' => 25]);
        $ajena = $this->pqrs(['user_id' => 999, 'area_id' => 3]);

        $this->actingAs($extranet)->get("/dashboard/comunicaciones/pqrsdf/{$ajena->id}")->assertForbidden();
        $this->actingAs($extranet)->get("/dashboard/comunicaciones/pqrsdf/{$ajena->id}/respuestas")->assertForbidden();
        $this->actingAs($control)->put("/dashboard/comunicaciones/pqrsdf/cancelar/{$ajena->id}", ['motivo_cancelacion' => 'motivo de prueba largo'])->assertForbidden();
        $this->actingAs($control)->delete("/dashboard/comunicaciones/pqrsdf/{$ajena->id}")->assertForbidden();
        $this->assertSame('Asignada', $ajena->fresh()->estado);
    }

    public function test_adjunto_ciudadano_privado(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('pqrsdf/radicados/abc.pdf', '%PDF-1.4 cedula');

        $extranet = $this->usuario('Extranet');
        $admin = $this->usuario('Administrador');
        $pqrs = $this->pqrs(['user_id' => 999]);
        $archivoId = DB::table('pqrsdf_archivos')->insertGetId(['pqrsdf_id' => $pqrs->id, 'ruta' => 'pqrsdf/radicados/abc.pdf', 'extension' => 'pdf', 'nombre_original' => 'cedula.pdf']);

        $this->get("/dashboard/comunicaciones/pqrsdf/archivo/$archivoId")->assertRedirect('/login');
        $this->actingAs($extranet)->get("/dashboard/comunicaciones/pqrsdf/archivo/$archivoId")->assertForbidden();
        $this->actingAs($admin)->get("/dashboard/comunicaciones/pqrsdf/archivo/$archivoId")->assertOk();
    }

    // 4. Formulario PQRSDF
    private function datosPqrs(array $extra = []): array
    {
        return array_merge([
            'discapacidad' => 0, 'identificado_anonimo' => 'identificado', 'tipo_solicitante' => 'Persona Natural',
            'tipo_identificacion' => 'Cédula de ciudadanía', 'numero_identificacion' => '123', 'nombre_usuario' => 'Ana', 'apellido_usuario' => 'Pérez',
            'correo_electronico' => 'ana@test.co', 'pais' => 'Colombia', 'departamento_id' => 41, 'municipio_id' => 1, 'direccion' => 'Calle 1',
            'movil' => '3001234567', 'tipo_pqrsf' => 'Denuncia', 'tipo_respuesta' => 'Correo Electrónico', 'asunto' => 'Asunto', 'descripcion' => 'Desc',
            'autoriza' => 1,
        ], $extra);
    }

    public function test_pqrsdf_identificada_sin_correo_es_rechazada(): void
    {
        $this->post('/participa/pqr', $this->datosPqrs(['correo_electronico' => '']))->assertSessionHasErrors('correo_electronico');
        $this->post('/participa/pqr', $this->datosPqrs(['correo_electronico' => 'no-es-correo']))->assertSessionHasErrors('correo_electronico');
        $this->post('/participa/pqr', $this->datosPqrs(['nombre_usuario' => '', 'movil' => '']))->assertSessionHasErrors(['nombre_usuario', 'movil']);
        $this->assertSame(0, EncuestaPqrsdf::count());
    }

    public function test_pqrsdf_identificada_no_puede_usar_cartelera(): void
    {
        $this->post('/participa/pqr', $this->datosPqrs(['tipo_respuesta' => 'Cartelera Virtual']))->assertSessionHasErrors('tipo_respuesta');
    }

    public function test_archivos_legitimos_no_se_rechazan(): void
    {
        $casos = [
            ['informe.pdf', "%PDF-1.4\n%âãÏÓ\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF"],
            ['datos.csv', "nombre,valor\nAna,1\n"],
            ['nota.txt', "Hola mundo"],
            ['foto.jpg', base64_decode('/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/wAALCAABAAEBAREA/8QAFAABAAAAAAAAAAAAAAAAAAAACf/EABQQAQAAAAAAAAAAAAAAAAAAAAD/2gAIAQEAAD8AKp//2Q==')],
            ['foto-renombrada.png', base64_decode('/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/wAALCAABAAEBAREA/8QAFAABAAAAAAAAAAAAAAAAAAAACf/EABQQAQAAAAAAAAAAAAAAAAAAAAD/2gAIAQEAAD8AKp//2Q==')],
        ];
        foreach ($casos as [$nombre, $contenido]) {
            $tmp = tempnam(sys_get_temp_dir(), 'leg');
            file_put_contents($tmp, $contenido);
            $ext = \App\Support\ArchivoSeguro::extension(new UploadedFile($tmp, $nombre, null, null, true), \App\Support\ArchivoSeguro::DOCUMENTOS_INSTITUCIONALES);
            $this->assertSame(pathinfo($nombre, PATHINFO_EXTENSION), $ext, $nombre);
        }

        $tmp = tempnam(sys_get_temp_dir(), 'mal');
        file_put_contents($tmp, '<html><script>alert(1)</script></html>');
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        \App\Support\ArchivoSeguro::extension(new UploadedFile($tmp, 'informe.pdf', null, null, true), \App\Support\ArchivoSeguro::DOCUMENTOS);
    }

    public function test_pqrsdf_identificada_completa_se_radica(): void
    {
        $this->post('/participa/pqr', $this->datosPqrs())->assertSessionHasNoErrors();
        $this->assertSame('ana@test.co', EncuestaPqrsdf::first()->correo_electronico);
    }

    public function test_pqrsdf_anonima_no_guarda_datos_personales(): void
    {
        $this->post('/participa/pqr', $this->datosPqrs(['identificado_anonimo' => 'anonimo', 'tipo_respuesta' => 'Correo Electrónico']))->assertSessionHasNoErrors();

        $pqrs = EncuestaPqrsdf::first();
        $this->assertSame('Cartelera Virtual', $pqrs->tipo_respuesta);
        $this->assertNull($pqrs->correo_electronico);
        $this->assertNull($pqrs->nombre_usuario);
        $this->assertNull($pqrs->numero_identificacion);
    }

    public function test_pqrsdf_adjunto_php_rechazado(): void
    {
        Storage::fake('local');
        $html = UploadedFile::fake()->createWithContent('x.html', '%PDF-1.4 <script>alert(1)</script>');
        $this->post('/participa/pqr', $this->datosPqrs(['documentos' => [$html]]))->assertSessionHasErrors('documentos.0');
        $this->assertSame(0, EncuestaPqrsdf::count());
    }

    public function test_pqrsdf_adjunto_valido_va_a_disco_privado(): void
    {
        Storage::fake('local');
        Storage::fake('public');
        $pdf = UploadedFile::fake()->create('mi cédula.pdf', 20, 'application/pdf');

        $this->post('/participa/pqr', $this->datosPqrs(['documentos' => [$pdf]]))->assertSessionHasNoErrors();

        $ruta = DB::table('pqrsdf_archivos')->value('ruta');
        $this->assertMatchesRegularExpression('#^pqrsdf/radicados/[0-9a-f-]{36}\.pdf$#', $ruta);
        Storage::disk('local')->assertExists($ruta);
        $this->assertEmpty(Storage::disk('public')->allFiles());
    }

    // 5. Cartelera virtual
    public function test_cartelera_limpia_html_de_la_respuesta(): void
    {
        $nueva = $this->pqrs(['identificado_anonimo' => 'anonimo', 'tipo_respuesta' => 'Cartelera Virtual', 'estado' => 'Respondida', 'fecha_respuesta' => now()]);
        PqrsdfRespuesta::forceCreate(['pqrsdf_id' => $nueva->id, 'tipo_respuesta' => 'Cartelera Virtual', 'estado' => 2, 'titulo_respuesta' => 'T', 'texto_respuesta' => '<p>Hola</p><img src=x onerror=alert(1)><script>alert(2)</script>']);

        $texto = $this->getJson("/participa/pqr/carteleravirtual/{$nueva->codigo_radicado}/respuesta")->assertOk()->json('texto');
        $this->assertStringContainsString('<p>Hola</p>', $texto);
        $this->assertStringNotContainsString('onerror', $texto);
        $this->assertStringNotContainsString('<script', $texto);
    }

    public function test_limite_de_envios_formulario_publico(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/participa/pqr/buscar', ['pqrsdf_code' => 'X']);
        }
        for ($i = 0; $i < 5; $i++) {
            $this->post('/participa/pqr/buscar', ['pqrsdf_code' => 'X']);
        }
        $this->post('/participa/pqr/buscar', ['pqrsdf_code' => 'X'])->assertStatus(429);
    }

    // 6. Cuestionario CACSP
    private function cacsp(array $respuestas, bool $autoriza = true, array $alternativas = []): \Illuminate\Testing\TestResponse
    {
        $this->municipiosCacsp();

        return $this->post('/transparencia-y-acceso-a-la-informacion-publica/cuestionario-de-evaluacion-de-atencion-al-cliente-servicios-publicos', [
            'respuestas' => array_replace_recursive([
                'a_codigo_suscriptor' => 'SUS-0042', 'b_municipio' => '21', 'c_ubicacion' => '1', 'd_estrato' => '3', 'e_sector' => '1',
                'P1_nombre' => 'Luz', 'P1_cedula' => '1075123456', 'P2_edad' => 30,
                'P3_sexo' => '2', 'P4_direccion' => 'Vereda X', 'P5_barrio' => 'Rural', 'P6_telefono' => '3001234567',
                'P44_fecha' => now()->toDateString(),
            ], $respuestas),
            'alternativas' => $alternativas,
        ] + ($autoriza ? ['autoriza' => 1] : []));
    }

    private function municipiosCacsp(): void
    {
        DB::table('municipios_col')->insertOrIgnore([
            ['id' => 10, 'departamento_id' => 18, 'nombre' => 'Neiva', 'estado' => 1],
            ['id' => 20, 'departamento_id' => 18, 'nombre' => 'Natagá', 'estado' => 1],
            ['id' => 21, 'departamento_id' => 18, 'nombre' => 'Paicol', 'estado' => 1],
            ['id' => 22, 'departamento_id' => 18, 'nombre' => 'SANTA MARIA', 'estado' => 1],
            ['id' => 23, 'departamento_id' => 18, 'nombre' => 'Tarqui', 'estado' => 1],
        ]);
    }

    private function cacspCompleto(): array
    {
        $cal = fn (array $filas, string $v = '4') => array_fill_keys($filas, $v);

        return [
            'P7' => ['acueducto' => '1', 'alcantarillado' => '2', 'aseo' => '1'],
            'P8' => '5', 'P9' => $cal(['continuidad', 'presion', 'calidad_agua']), 'P10' => '2',
            'P14' => $cal(['aviso_suspension', 'factura_entender', 'exactitud_cobros', 'tiempo_pago']), 'P15' => $cal(['formas_pago', 'puntos_pago']),
            'P16' => '2', 'P18' => '1', 'P19' => '4', 'P20' => $cal(['horarios', 'ubicacion', 'comodidad', 'tiempo', 'amabilidad', 'respuesta', 'claridad'], '9'),
            'P21' => ['cantidad' => '20', 'unidad' => 'minutos'], 'P23' => '1',
            'P24' => 'Ciudad Limpia', 'P25' => '3', 'P26' => $cal(['cumplimiento']), 'P27' => $cal(['factura_entender', 'tiempo_pago']),
            'P28' => $cal(['formas_pago', 'puntos_pago']), 'P29' => '2',
            'P35' => $cal(['participo', 'separa', 'canecas', 'dias_organicos', 'conoce_dias', 'continuar'], '1'),
            'P36' => $cal(['parques', 'barrido']), 'P37' => ['1', '6'], 'P37_otro' => 'Poda de árboles',
            'P38' => ['acueducto' => '3', 'aseo' => '2'], 'P39' => ['acueducto' => '2', 'aseo' => '1'], 'P40' => ['acueducto' => '1', 'aseo' => '9'],
            'P41' => 'Continuidad', 'P43' => 'Puntualidad',
            // Respuestas de preguntas que deben ignorarse (ocultas por los saltos)
            'P11' => '3', 'P12' => '5', 'P17' => '1', 'P30' => '5',
        ];
    }

    public function test_cacsp_sin_acueducto_termina_la_encuesta(): void
    {
        $this->cacsp(['P7' => ['acueducto' => '2', 'alcantarillado' => '1', 'aseo' => '1'], 'P8' => '5', 'P24' => 'X'])->assertSessionHasNoErrors();

        $claves = DB::table('cuestionarios_cacsp_respuestas')->pluck('pregunta_key')->all();
        $this->assertEqualsCanonicalizing(['a_codigo_suscriptor', 'P1_cedula', 'P7.acueducto', 'P7.alcantarillado', 'P7.aseo'], $claves);
    }

    public function test_cacsp_condicionales_obligatorias(): void
    {
        $this->cacsp(['P7' => ['acueducto' => '1', 'alcantarillado' => '2', 'aseo' => '2']])
            ->assertSessionHasErrors(['respuestas.P8', 'respuestas.P9.continuidad', 'respuestas.P10', 'respuestas.P41'])
            ->assertSessionDoesntHaveErrors(['respuestas.P12', 'respuestas.P24', 'respuestas.P11']);

        $datos = $this->cacspCompleto();
        unset($datos['P37_otro']);
        $this->cacsp($datos)->assertSessionHasErrors('respuestas.P37_otro');
        $this->assertSame(0, DB::table('cuestionarios_cacsp')->count());
    }

    public function test_cacsp_completo_respeta_saltos_y_formatos(): void
    {
        $this->cacsp($this->cacspCompleto(), true, ['P6_telefono' => 1, 'P42' => 1])->assertSessionHasNoErrors();

        $c = DB::table('cuestionarios_cacsp')->first();
        $this->assertSame('9999999', $c->telefono);
        $this->assertSame('URBANO', $c->ubicacion);
        $this->assertSame('FEMENINO', $c->sexo);

        $r = DB::table('cuestionarios_cacsp_respuestas')->pluck('valor', 'pregunta_key');
        $this->assertSame('20 minutos', $r['P21']);
        $this->assertSame('1075123456', $r['P1_cedula']);
        $this->assertSame('SUS-0042', $r['a_codigo_suscriptor']);
        $this->assertSame('["1","6"]', $r['P37']);
        $this->assertSame('Poda de árboles', $r['P37_otro']);
        $this->assertSame('4', $r['P9.presion']);
        foreach (['P11', 'P12', 'P13.olores', 'P17', 'P30', 'P38.alcantarillado', 'P42'] as $oculta) {
            $this->assertArrayNotHasKey($oculta, $r->all(), "$oculta debía ignorarse");
        }
    }

    public function test_cacsp_ajustes_municipios_ubicacion_y_cedula(): void
    {
        // Solo los cuatro municipios, solo urbano y cédula numérica
        $this->cacsp(['b_municipio' => '10', 'c_ubicacion' => '2', 'P1_cedula' => '10.751', 'P7' => ['acueducto' => '2', 'alcantarillado' => '2', 'aseo' => '2']])
            ->assertSessionHasErrors(['respuestas.b_municipio', 'respuestas.c_ubicacion', 'respuestas.P1_cedula']);
        $this->cacsp(['a_codigo_suscriptor' => '', 'P7' => ['acueducto' => '2', 'alcantarillado' => '2', 'aseo' => '2']])
            ->assertSessionHasErrors('respuestas.a_codigo_suscriptor');
    }

    public function test_cacsp_santa_maria_sin_aseo(): void
    {
        // Aunque llegue "aseo = Sí" y respuestas de aseo, en Santa María se ignoran
        $datos = $this->cacspCompleto();
        $datos['b_municipio'] = '22';
        $this->cacsp($datos)->assertSessionHasNoErrors();

        $claves = DB::table('cuestionarios_cacsp_respuestas')->pluck('pregunta_key')->all();
        $this->assertContains('P8', $claves);
        foreach (['P7.aseo', 'P24', 'P25', 'P35.participo', 'P37', 'P38.aseo', 'P43'] as $aseo) {
            $this->assertNotContains($aseo, $claves, "$aseo no debía guardarse en Santa María");
        }

        // En Santa María no se exigen las preguntas de aseo
        $sinAseo = $this->cacspCompleto();
        $sinAseo['b_municipio'] = '22';
        unset($sinAseo['P24'], $sinAseo['P25'], $sinAseo['P35'], $sinAseo['P37'], $sinAseo['P37_otro'], $sinAseo['P7']['aseo']);
        $this->cacsp($sinAseo)->assertSessionHasNoErrors();
    }

    public function test_cacsp_requiere_autorizacion_y_valores_validos(): void
    {
        $this->cacsp(['P7' => ['acueducto' => '2', 'alcantarillado' => '2', 'aseo' => '2']], false)->assertSessionHasErrors('autoriza');
        $this->cacsp(['P7' => ['acueducto' => '2', 'alcantarillado' => '2', 'aseo' => '2'], 'd_estrato' => '9', 'P2_edad' => 15, 'P6_telefono' => 'abc'])
            ->assertSessionHasErrors(['respuestas.d_estrato', 'respuestas.P2_edad', 'respuestas.P6_telefono']);
    }

    public function test_cacsp_formulario_por_pasos(): void
    {
        $this->municipiosCacsp();

        $this->get('/transparencia-y-acceso-a-la-informacion-publica/cuestionario-de-evaluacion-de-atencion-al-cliente-servicios-publicos')
            ->assertOk()->assertSee('cx-paso', false)->assertSee('Revisión y envío')->assertSee('Paicol')->assertSee('SANTA MARIA')
            ->assertDontSee('<option value="10"', false)->assertDontSee('>Rural<', false)->assertSee('Código suscriptor')->assertSee('Número de cédula')
            ->assertDontSee('Encuestador')->assertDontSee('Supervisor')->assertSee('cacsp-reglas', false);

        $this->cacsp(['P7' => ['acueducto' => '2', 'alcantarillado' => '2', 'aseo' => '2']]);
        $this->get('/transparencia-y-acceso-a-la-informacion-publica/cuestionario-de-evaluacion-de-atencion-al-cliente-servicios-publicos')
            ->assertSee('¡Cuestionario enviado!')->assertSee('Registrar otro cuestionario');
    }

    public function test_cacsp_resultados_listado_detalle_y_exportacion(): void
    {
        $admin = $this->usuario('Administrador');
        $this->actingAs($admin)->get('/dashboard/encuestas/cacsp')->assertOk()->assertSee('Todavía no hay cuestionarios');

        $this->cacsp($this->cacspCompleto())->assertSessionHasNoErrors();
        $id = DB::table('cuestionarios_cacsp')->value('id');

        $this->actingAs($admin)->get('/dashboard/encuestas/cacsp?periodo=30')->assertOk()
            ->assertViewHas('kpis', fn ($k) => $k['Calidad del Acueducto'] === 100 && $k['Calidad del Aseo'] === 0 && $k['Calidad del Alcantarillado'] === null)
            ->assertSee('Ciudad Limpia')->assertSee('Poda de árboles');

        $this->actingAs($admin)->get('/dashboard/encuestas/cacsp/respuestas?buscar=Vereda')->assertOk()->assertSee('Luz')->assertSee('Paicol');
        $this->actingAs($admin)->get('/dashboard/encuestas/cacsp/respuestas?buscar=1075123456')->assertOk()->assertSee('SUS-0042');
        $this->actingAs($admin)->get("/dashboard/encuestas/cacsp/respuestas/$id")->assertOk()->assertSee('20 minutos')->assertSee('Muy buena');

        $csv = $this->actingAs($admin)->get('/dashboard/encuestas/cacsp/exportar')->assertOk()->streamedContent();
        $this->assertStringContainsString('Municipio', $csv);
        $this->assertStringContainsString('Paicol', $csv);
        $this->assertStringContainsString('1075123456', $csv);
        $this->assertStringContainsString('Recolección de basuras en domicilios, Otro', $csv);

        $this->actingAs($this->usuario('Extranet'))->delete("/dashboard/encuestas/cacsp/respuestas/$id")->assertForbidden();
        $this->actingAs($admin)->delete("/dashboard/encuestas/cacsp/respuestas/$id")->assertRedirect();
        $this->assertSame(0, DB::table('cuestionarios_cacsp_respuestas')->count());
    }

    // 7. Días hábiles y usuarios
    public function test_dias_habiles_colombia(): void
    {
        $this->assertSame('2026-11-03', \App\Support\DiasHabiles::sumar(\Carbon\Carbon::parse('2026-10-30'), 1)->toDateString());
        $this->assertSame('2026-11-20', \App\Support\DiasHabiles::sumar(\Carbon\Carbon::parse('2026-10-28'), 15)->toDateString());
        $this->assertTrue(\App\Support\DiasHabiles::esFestivo(\Carbon\Carbon::parse('2026-04-03')));
    }

    public function test_usuario_se_deshabilita_no_se_borra(): void
    {
        $admin = $this->usuario('Administrador');
        $otro = $this->usuario('Editor');

        $this->actingAs($admin)->delete("/dashboard/usuarios/{$otro->id}")->assertRedirect();

        $this->assertDatabaseHas('users', ['id' => $otro->id, 'estado' => 'Desactivado']);
    }

    // 8. Panel de encuestas
    public function test_panel_encuestas_con_y_sin_datos(): void
    {
        $admin = $this->usuario('Administrador');

        foreach (['30', '90', '365', 'todo'] as $periodo) {
            $this->actingAs($admin)->get("/dashboard/encuestas?periodo=$periodo")->assertOk()->assertSee('Sin respuestas en este período');
        }

        DB::table('encuesta_satisfaccion')->insert([
            ['tramite' => 'Matrícula', 'medio' => 'Presencial', 'informacion' => 'Excelente', 'facilidad' => 'Si', 'grupo' => 'Ciudadano', 'beneficio' => 'Alto', 'costos' => 'Transporte', 'created_at' => now()->subDays(3)],
            ['tramite' => 'Matrícula', 'medio' => 'Página web', 'informacion' => 'Mala', 'facilidad' => 'No', 'grupo' => 'Empresa', 'beneficio' => 'Leve', 'costos' => null, 'created_at' => now()->subDays(40)],
        ]);
        DB::table('encuesta_evaluacion')->insert(['actualizada' => 'Actualizada', 'informacion' => 'Si, toda', 'satisfaccion' => 'Satisfecho', 'facilidad' => 'Si', 'created_at' => now()->subDays(1)]);

        $respuesta = $this->actingAs($admin)->get('/dashboard/encuestas?periodo=30')->assertOk();
        $respuesta->assertViewHas('estadisticas', fn ($e) => $e['tramites']['total'] === 1
            && $e['tramites']['kpis']['informacion'] === 100
            && $e['evaluacion']['kpis']['satisfaccion'] === 100
            && $e['tramites']['top']['Matrícula'] === 1);
        $respuesta->assertSee('Transporte');

        $this->actingAs($admin)->get('/dashboard/encuestas?periodo=todo')->assertOk()
            ->assertViewHas('estadisticas', fn ($e) => $e['tramites']['total'] === 2 && $e['tramites']['kpis']['informacion'] === 50);

        // Pestañas: cada encuesta en su propia página
        $this->actingAs($admin)->get('/dashboard/encuestas?tab=evaluacion&periodo=30')->assertOk()
            ->assertViewHas('tab', 'evaluacion')->assertSee('Evaluación del sitio web')->assertDontSee('Costos reportados');
        $this->actingAs($admin)->get('/dashboard/encuestas?tab=tramites')->assertOk()
            ->assertSee('Costos reportados')->assertDontSee('¿Fue fácil navegar el sitio?');
        $this->actingAs($admin)->get('/dashboard/encuestas/cacsp')->assertOk()->assertSee('Atención al cliente (CACSP)');
    }
}
