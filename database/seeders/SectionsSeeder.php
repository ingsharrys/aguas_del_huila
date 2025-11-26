<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            // Inicio
            ['titulo' => 'Inicio', 'route' => 'home', 'etiquetas' => 'inicio,home,portada,principal,aguas del huila,landing'],
            // Noticias
            ['titulo' => 'Noticias', 'route' => 'noticias.blog', 'etiquetas' => 'noticias,actualidad,prensa,información'],
            // Inversiones
            ['titulo' => 'Inversiones', 'route' => 'noticias.blog', 'etiquetas' => 'inversiones,proyectos,recursos,ejecución'],
            // Indicadores
            ['titulo' => 'Indicadores', 'route' => 'noticias.blog', 'etiquetas' => 'indicadores,estadísticas,mediciones'],
            // Contratacion
            ['titulo' => 'Procesos Contractuales', 'route' => 'contrato', 'etiquetas' => 'procesos,contractuales,contratos,contratación'],
            ['titulo' => 'Procesos Contractuales: Parte 2', 'route' => 'contratodos', 'etiquetas' => 'procesos,contractuales,contratos,contratación'],
            // Institucional
            ['titulo' => 'Historia', 'route' => 'historia', 'etiquetas' => 'historia,entidad,origen,antecedentes, Misión y Visión, Organigrama'],
            ['titulo' => 'Funciones Generales', 'route' => 'funcionesgenerales', 'etiquetas' => 'funciones,competencias,responsabilidades'],
            ['titulo' => 'Representante Legal', 'route' => 'nuestrogerente', 'etiquetas' => 'representante,gerente,dirección'],
            ['titulo' => 'Gestión de Calidad', 'route' => 'gestioncalidad', 'etiquetas' => 'calidad,procesos,certificación'],
            ['titulo' => 'Normatividad', 'route' => 'normatividad', 'etiquetas' => 'normatividad,leyes,decretos,resoluciones, Normatividad Interna, Normatividad Externa'],
            ['titulo' => 'Inducción', 'route' => 'induccion', 'etiquetas' => 'inducción,bienvenida,empleados'],
            ['titulo' => 'Directorio Aguas del Huila', 'route' => 'directorio', 'etiquetas' => 'directorios,aguas del huila'],
            ['titulo' => 'Glosario', 'route' => 'glosario', 'etiquetas' => 'glosario,términos,definiciones'],
            ['titulo' => 'Preguntas Frecuentes', 'route' => 'preguntasfrecuentes', 'etiquetas' => 'faq,preguntas frecuentes,respuestas'],
            // Transparencia
            ['titulo' => 'Transparencia y Acceso a la Información Pública', 'route' => 'transparencia', 'etiquetas' => 'transparencia,ley 1712,entidad,contacto,atención,soporte, Datos abiertos'],
            ['titulo' => 'Entes de Control', 'route' => 'entescontrol', 'etiquetas' => 'transparencia,normativa,documentos,control,entes'],
            ['titulo' => 'Oficinas - Sedes', 'route' => 'oficinas', 'etiquetas' => 'planeación,transparencia,planes,sedes,oficinas,puntos de antención, procedimientos, Horarios'],
            // Documentos
            ['titulo' => 'Archivo Documental', 'route' => 'posts.download', 'etiquetas' => 'archivo, documentos, pdf, descargas, Plan de Acción, Plan Anticorrupción y Atención al Ciudadano (PAAC), Mapa de Riesgos, Plan Estratégico, Informes de Gestión, Informes de Actividades, Ejecuciones Presupuestales, Plan Institucional, Informes, Plan Anual de Adquisiciones, contratos, proyectos, Estados Financieros, Presupuesto General, Políticas anticorrupción, politica'],
            // Mapa del sitio
            ['titulo' => 'Mapa del Sitio', 'route' => 'gestioncalidad', 'etiquetas' => 'mapa,navegación,secciones'],
            // Participa
            ['titulo' => 'Participa', 'route' => 'participacion', 'etiquetas' => 'participación, participa, ciudadania, opinion, comunidad, participación ciudadana, colaboracion, iniciativas, Atención al usuario'],
            ['titulo' => 'Convocatorias', 'route' => 'convocatoria', 'etiquetas' => 'convocatorias, ofertas, procesos, inscripciones, llamados, oportunidades, postulaciones'],
            ['titulo' => 'Calendario', 'route' => 'calendario', 'etiquetas' => 'calendario, agenda, eventos, programación, fechas, actividades, cronograma'],
            ['titulo' => 'PQR', 'route' => 'pqr', 'etiquetas' => 'pqr, peticiones, quejas, reclamos, solicitudes, atención al usuario, servicio al cliente, trámites'],
            ['titulo' => 'Foro', 'route' => 'foro', 'etiquetas' => 'foro, discusión, debates, comunidad, participación, temas, conversación, opinión'],
            ['titulo' => 'Chat', 'route' => 'chat', 'etiquetas' => 'chat, atención instantánea, soporte, comunicación, servicio en línea, ayuda, contacto rápido'],
            ['titulo' => 'Denuncias', 'route' => 'denuncias', 'etiquetas' => 'denuncias, reporte, información, irregularidades, quejas formales, transparencia, integridad'],
            ['titulo' => 'Directorio de Funcionarios', 'route' => 'directoriofuncionarios', 'etiquetas' => 'directorio, funcionarios, empleados, contacto institucional, personal, dependencia, información de contacto'],
            // Pagos
            ['titulo' => 'Pagos en Línea', 'route' => 'pagos', 'etiquetas' => 'pagos, pagos en línea, facturación, recaudo, electrónico, transacciones, servicios, plataforma de pagos'],
            // Nacederos
            ['titulo' => 'Nacederos', 'route' => 'nacederos', 'etiquetas' => 'nacederos, fuentes hídricas, reservas naturales, agua, ecosistemas, conservación, recursos naturales'],
        ];

        Section::insert($sections);
    }
}
