<div>
    <h2>Historial de Aplicaciones</h2>

    @foreach ($historia as $application)
        <div class="timeline-task">
            <div class="icon bg1">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="tm-title">
                <h4>{{ $application->tipo }}</h4>
                <span class="time"><i class="ti-time"></i>{{ $application->created_at }}</span>
            </div>
            <p>{{ $application->descripcion }}
            </p>
        </div>
    @endforeach

</div>
