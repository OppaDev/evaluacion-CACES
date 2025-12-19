<li class="nav-item">
    <a class="nav-link collapsed" id="" href="{{ route(name: 'universidades.index') }}">
        <i class="bi bi-arrow-return-left"></i><span>Regresar</span>
    </a>
</li>
<li>
    <hr class="modulo-divider">
</li>
<li class="nav-heading">EVALUACIONES</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="evaluaciones" href="{{ route('evaluaciones.show', $universidad->id) }}">
        <i class="fas fa-poll"></i><span style="padding-left: 10px;">Evaluaciones</span>
    </a>
</li>
<li class="nav-heading">HISTORICOS</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="grafico" href="{{ route('historico.grafico.index', $universidad->id) }}">
        <i class="fas fa-chart-bar"></i><span style="padding-left: 10px;">Gráfico</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="historico" href="{{ route('historico.index', $universidad->id) }}">
        <i class="fas fa-history"></i><span style="padding-left: 10px;">Historico</span>
    </a>
</li>
