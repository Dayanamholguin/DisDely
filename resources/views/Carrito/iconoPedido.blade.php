<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAU9JREFUSEvN1U1WgzAQB/B/2u71AoaybwjcQE9gb2Dd6kK9gZ5AN7oVT6DeQE9AQ3FdG92Le2H66PODVkrTUnyynWR+GYYMDDU/rOb8+DtADTR9VhOD4EuHn6yjuu8KcsAkbwq244mth6rIr1ekotExiJ2D4V52eHftQBAMNxut5tukio/E9jz7uQpS2GQVah8Me6snpr4UlpftLwSCp1e3kaZBBWAkhdWeC2SB/kD3GSBXQ+hMCuu0FAhD3SOG61WAfO9KL5oKdQyGjSWRRyn49teecmDwcgHQ0TIAI+w7DveNgCAYthut5tAYILynSdL2PDs2ArJFKtJ3IOwaIYQb6fBefu3CYReGuksMtyZA0XhZCJh+sgQoV3B39iBGgMnp560xAlSkL0E4AMOV7PDDfLKyWOlFm0ry86+AFHzqUPkxPxszB+quoPYe/GtgDP3pghm+phzYAAAAAElFTkSuQmCC" />
        <span class="badge badge-danger badge-counter">{{count(Cart::getContent())>0?count(Cart::getContent()):0}}</span>
    </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            {{count(\Cart::getContent()) > 0? 'Productos añadidos' : 'Carrito vacío'}}
        </h6>
        @if(count(\Cart::getContent()) > 0)
            @foreach(\Cart::getContent() as $item)
                <a class="dropdown-item d-flex align-items-center" href="/carritoPedido/{{$item->attributes->clienteId}}">
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
            <a class="dropdown-item text-center small text-gray-500" href="/carritoPedido/{{$item->attributes->clienteId}}" data-toggle="tooltip" data-placement="bottom" title="Ver carrito">Ver carrito</a>
        @endif
    </div>
</li>