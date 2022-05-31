<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAU9JREFUSEvN1U1WgzAQB/B/2u71AoaybwjcQE9gb2Dd6kK9gZ5AN7oVT6DeQE9AQ3FdG92Le2H66PODVkrTUnyynWR+GYYMDDU/rOb8+DtADTR9VhOD4EuHn6yjuu8KcsAkbwq244mth6rIr1ekotExiJ2D4V52eHftQBAMNxut5tukio/E9jz7uQpS2GQVah8Me6snpr4UlpftLwSCp1e3kaZBBWAkhdWeC2SB/kD3GSBXQ+hMCuu0FAhD3SOG61WAfO9KL5oKdQyGjSWRRyn49teecmDwcgHQ0TIAI+w7DveNgCAYthut5tAYILynSdL2PDs2ArJFKtJ3IOwaIYQb6fBefu3CYReGuksMtyZA0XhZCJh+sgQoV3B39iBGgMnp560xAlSkL0E4AMOV7PDDfLKyWOlFm0ry86+AFHzqUPkxPxszB+quoPYe/GtgDP3pghm+phzYAAAAAElFTkSuQmCC" />
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter">{{count(Cart::getContent())>0?count(Cart::getContent()):0}}</span>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            {{count(\Cart::getContent()) > 0? 'Productos añadidos' : 'Carrito vacío'}}
            <!-- <div style="float: right;" style="margin-top: 1px;">
                <form action="/limpiarCarrito" class="form-inline" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Limpiar carrito"><i class="fa fa-trash"></i></button>
                </form>
            </div> -->
        </h6>
        @if(count(\Cart::getContent()) > 0)
            @foreach(\Cart::getContent() as $item)
                <a class="dropdown-item d-flex align-items-center" href="/carrito">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="/imagenes/{{$item->attributes->img}}" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        
                        <div class="text-truncate">{{$item->name}}</div>
                        <div class="small text-gray-500">{{$item->attributes->cliente}}</div>
                    </div>
                </a>    
            @endforeach
            <a class="dropdown-item text-center small text-gray-500" href="/carrito" data-toggle="tooltip" data-placement="bottom" title="Ver carrito">Ver carrito</a>
        @endif

        <!-- <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                <div class="status-indicator"></div>
            </div>
            <div>
                <div class="text-truncate">I have the photos that you ordered last month, how
                    would you like them sent to you?</div>
                <div class="small text-gray-500">Jae Chun · 1d</div>
            </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                <div class="status-indicator bg-warning"></div>
            </div>
            <div>
                <div class="text-truncate">Last month's report looks great, I am very happy with
                    the progress so far, keep up the good work!</div>
                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
            </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                <div class="status-indicator bg-success"></div>
            </div>
            <div>
                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                    told me that people say this to all dogs, even if they aren't good...</div>
                <div class="small text-gray-500">Chicken the Dog · 2w</div>
            </div>
        </a> -->
        <!-- @if(count(Cart::getContent())>4)
        <a class="dropdown-item text-center small text-gray-500" href="#">Ver más</a>
        @endif -->
    </div>
</li>