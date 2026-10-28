<style>
    .enc {
        color-scheme: dark;
        --surface: #1a1a19;
        --surface-2: #232322;
        --borde: #34342f;
        --texto: #f0efec;
        --texto-2: #c3c2b7;
        --texto-3: #8f8e86;
        --serie-1: #3987e5;
        --serie-2: #d95926;
        --pos-2: #3987e5;
        --pos-1: #1c5cab;
        --neutro: #4a4a46;
        --neg-1: #9b3a3a;
        --neg-2: #e66767;
        --seq-4: #3987e5;
        --seq-3: #256abf;
        --seq-2: #1c5cab;
        --seq-1: #184f95;
        --bueno: #0ca30c;
        --critico: #e66767;
        --ns: #6b6a63;
        --cat-1: #3987e5;
        --cat-2: #d95926;
        --cat-3: #199e70;
        --cat-4: #c98500;
        font-family: inherit;
        color: var(--texto);
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
    }
    .enc * { box-sizing: border-box; }
    .enc h1, .enc h2, .enc h3, .enc p { margin: 0; }

    /* Encabezado y filtros */
    .enc-cabecera { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px; }
    .enc-titulo { font-size: 26px; font-weight: 800; letter-spacing: -0.02em; }
    .enc-subtitulo { color: var(--texto-3); font-size: 14px; margin-top: 4px; }
    .enc-segmento { display: inline-flex; background: var(--surface); border: 1px solid var(--borde); border-radius: 10px; padding: 3px; gap: 2px; }
    .enc-segmento a { padding: 7px 14px; border-radius: 7px; font-size: 13px; font-weight: 600; color: var(--texto-2); text-decoration: none; white-space: nowrap; }
    .enc-segmento a:hover { color: var(--texto); background: var(--surface-2); }
    .enc-segmento a[aria-current="page"] { background: var(--texto); color: #111; }

    /* Tarjetas */
    .enc-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
    .enc-grid-2 { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(min(100%, 420px), 1fr)); }
    .enc-tarjeta { background: var(--surface); border: 1px solid var(--borde); border-radius: 14px; padding: 20px; min-width: 0; }
    .enc-tarjeta-cab { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 16px; }
    .enc-tarjeta h3 { font-size: 15px; font-weight: 700; color: var(--texto); line-height: 1.35; }
    .enc-tarjeta .enc-nota { font-size: 12px; color: var(--texto-3); margin-top: 3px; }

    /* Indicadores */
    .enc-kpi-etiqueta { font-size: 13px; color: var(--texto-2); font-weight: 500; }
    .enc-kpi-valor { font-size: 34px; font-weight: 800; letter-spacing: -0.03em; margin-top: 8px; line-height: 1; font-variant-numeric: tabular-nums; }
    .enc-kpi-pie { display: flex; align-items: center; gap: 8px; margin-top: 12px; font-size: 12px; color: var(--texto-3); }
    .enc-delta { display: inline-flex; align-items: center; gap: 3px; font-weight: 700; padding: 2px 7px; border-radius: 999px; font-size: 12px; }
    .enc-delta.sube { color: var(--bueno); background: rgba(12, 163, 12, .12); }
    .enc-delta.baja { color: var(--critico); background: rgba(230, 103, 103, .12); }
    .enc-medidor { height: 6px; border-radius: 999px; background: var(--surface-2); margin-top: 14px; overflow: hidden; }
    .enc-medidor span { display: block; height: 100%; border-radius: 999px; background: var(--serie-1); }

    /* Secciones */
    .enc-seccion { display: flex; flex-direction: column; gap: 16px; }
    .enc-seccion-cab { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; padding-top: 8px; }
    .enc-seccion-cab h2 { font-size: 19px; font-weight: 800; letter-spacing: -0.01em; }
    .enc-acciones { display: flex; flex-wrap: wrap; gap: 8px; }
    .enc-boton { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 9px; font-size: 13px; font-weight: 600; text-decoration: none; border: 1px solid var(--borde); color: var(--texto); background: var(--surface); }
    .enc-boton:hover { background: var(--surface-2); }
    .enc-boton.primario { background: #2a78d6; border-color: #2a78d6; color: #fff; }
    .enc-boton.primario:hover { background: #256abf; }
    .enc-boton svg { width: 15px; height: 15px; }

    /* Barra apilada (escalas) */
    .enc-apilada { display: flex; gap: 2px; height: 28px; border-radius: 6px; overflow: hidden; }
    .enc-apilada > div { height: 100%; min-width: 3px; cursor: default; transition: opacity .15s; }
    .enc-apilada > div:first-child { border-radius: 4px 0 0 4px; }
    .enc-apilada > div:last-child { border-radius: 0 4px 4px 0; }
    .enc-apilada:hover > div { opacity: .55; }
    .enc-apilada:hover > div:hover { opacity: 1; }
    .enc-leyenda { list-style: none; padding: 0; margin: 14px 0 0; display: grid; gap: 7px; }
    .enc-leyenda li { display: grid; grid-template-columns: 10px 1fr auto auto; align-items: center; gap: 10px; font-size: 13px; color: var(--texto-2); }
    .enc-leyenda i { width: 10px; height: 10px; border-radius: 3px; display: block; }
    .enc-leyenda b { color: var(--texto); font-weight: 700; font-variant-numeric: tabular-nums; text-align: right; }
    .enc-leyenda small { color: var(--texto-3); font-size: 12px; min-width: 34px; text-align: right; font-variant-numeric: tabular-nums; }

    /* Barras horizontales (categorías) */
    .enc-barras { display: grid; gap: 12px; }
    .enc-barra-fila { display: grid; gap: 6px; }
    .enc-barra-texto { display: flex; justify-content: space-between; gap: 8px; font-size: 13px; color: var(--texto-2); }
    .enc-barra-texto b { color: var(--texto); font-variant-numeric: tabular-nums; }
    .enc-barra-pista { height: 8px; background: var(--surface-2); border-radius: 4px; overflow: hidden; }
    .enc-barra-pista span { display: block; height: 100%; background: var(--serie-1); border-radius: 0 4px 4px 0; }

    /* Indicador Sí/No */
    .enc-sino { display: flex; align-items: center; gap: 18px; }
    .enc-anillo { --p: 0; width: 84px; height: 84px; border-radius: 50%; flex-shrink: 0; background: conic-gradient(var(--pos-2) calc(var(--p) * 1%), var(--surface-2) 0); display: grid; place-items: center; }
    .enc-anillo span { width: 64px; height: 64px; border-radius: 50%; background: var(--surface); display: grid; place-items: center; font-size: 18px; font-weight: 800; font-variant-numeric: tabular-nums; }

    /* Comentarios */
    .enc-comentarios { list-style: none; margin: 0; padding: 0; display: grid; gap: 12px; }
    .enc-comentarios li { padding: 12px 14px; border-radius: 10px; background: var(--surface-2); }
    .enc-comentarios p { font-size: 13px; color: var(--texto); line-height: 1.5; }
    .enc-comentarios small { display: block; font-size: 11px; color: var(--texto-3); margin-top: 6px; }

    .enc-vacio { color: var(--texto-3); font-size: 13px; padding: 18px 0; text-align: center; }
    .enc-grafico { position: relative; height: 260px; }

    /* Tooltip */
    .enc-tooltip { position: fixed; z-index: 60; pointer-events: none; background: #0b0b0b; color: #f0efec; border: 1px solid var(--borde); border-radius: 8px; padding: 8px 10px; font-size: 12px; line-height: 1.4; box-shadow: 0 8px 24px rgba(0, 0, 0, .4); opacity: 0; transition: opacity .1s; max-width: 240px; }
    .enc-tabla { width: 100%; border-collapse: collapse; font-size: 13px; }
    .enc-tabla th { text-align: left; color: var(--texto-3); font-weight: 600; font-size: 12px; padding: 10px 12px; border-bottom: 1px solid var(--borde); white-space: nowrap; }
    .enc-tabla td { padding: 11px 12px; border-bottom: 1px solid var(--borde); color: var(--texto-2); vertical-align: top; }
    .enc-tabla tr:hover td { background: var(--surface-2); }
    .enc-tabla a { color: #86b6ef; text-decoration: none; font-weight: 600; }
    .enc-filtros { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .enc-filtros select, .enc-filtros input { background: var(--surface); color: var(--texto); border: 1px solid var(--borde); border-radius: 9px; padding: 8px 12px; font-size: 13px; }
    .enc-matriz-fila { display: grid; grid-template-columns: minmax(0, 1fr) minmax(120px, 42%) 48px; gap: 14px; align-items: center; padding: 10px 0; border-top: 1px solid var(--borde); }
    .enc-matriz-fila:first-of-type { border-top: 0; }
    .enc-matriz-fila > span:first-child { font-size: 13px; color: var(--texto-2); line-height: 1.35; }
    .enc-matriz-fila .enc-apilada { height: 18px; }
    .enc-matriz-fila b { text-align: right; font-variant-numeric: tabular-nums; font-size: 14px; }
    @media (max-width: 640px) { .enc-matriz-fila { grid-template-columns: 1fr 48px; } .enc-matriz-fila .enc-apilada { grid-column: 1 / -1; order: 3; } }
    .enc-leyenda-linea { display: flex; flex-wrap: wrap; gap: 6px 14px; margin-top: 12px; font-size: 12px; color: var(--texto-3); }
    .enc-leyenda-linea span { display: inline-flex; align-items: center; gap: 6px; }
    .enc-leyenda-linea i { width: 10px; height: 10px; border-radius: 3px; display: inline-block; }
    /* Pestañas entre encuestas */
    .enc-tabs { display: flex; gap: 4px; border-bottom: 1px solid var(--borde); overflow-x: auto; scrollbar-width: none; }
    .enc-tabs a { display: inline-flex; align-items: center; gap: 8px; padding: 12px 16px; font-size: 14px; font-weight: 600; color: var(--texto-3); text-decoration: none; border-bottom: 2px solid transparent; margin-bottom: -1px; white-space: nowrap; }
    .enc-tabs a:hover { color: var(--texto); }
    .enc-tabs a[aria-current="page"] { color: var(--texto); border-bottom-color: #3987e5; }
    .enc-tabs small { font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 999px; background: var(--surface-2); color: var(--texto-2); font-variant-numeric: tabular-nums; }
    .enc-tooltip b { display: block; font-size: 13px; }
</style>
