<header class="cabecera">
    <div class="content_contenido_cabecera">
        <div class="presentacion">
            <h1>Asomavilla</h1>
        </div>
        <div class="usuario">
            <div class="nameu">
                <h4>Bienvenido</h4>
                <p>Usuario en línea: {{ auth()->user()->name }} </p>
            </div>

            <div class="cerrar">
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Cerrar sesión"><img src="{!! asset('img/closed.png') !!}" width="32" title="cerrar sesión"></button>
            </div>

            </form>
        </div>
    </div>
</header>

<nav class="navppal">
    <div class="nav-movil">
        <a id="nav-boton" href="javascript:void(0);" class="icon" onclick="myFunction()" class="icon" title="Botón de navegación">
            <img src="{!! asset('img/menu.png') !!}" alt="" width="32" title="menu">
        </a>
    </div>
    <ul class="nav-menu" id="myIconbar">
        <li><a href="{!! asset('ppal') !!}" class="{{request()->routeIs('index') ? 'active' : ''}}"><img src="{!! asset('img/home.png') !!}" width="24" title="home"><span> Home</span></a></li>

        @can('usuarios.index')
        <li><a href="#" class="{{request()->routeIs('usuarios.index', 'usuarios.create', 'usuarios.edit', 'usuarios-cxc', 'gastos.index', 'gastos.create', 'gastos.edit', 'comunicados.index', 'comunicados.create', 'comunicados.edit', 'facturas.index', 'facturas.create', 'facturas.edit', 'facturas.show', 'ver-ctasxc', 'ver-recobro', 'fondos.index', 'fondos.create', 'fondos.edit', 'ver-conciliar-pagos') ? 'active' : ''}}"><img src="{!! asset('img/admini.png') !!}" width="24" title="administración"><span>Administración</span></a>
            @endcan
            <ul class="nav-submenu" id="smn">
                <li><a href="{{route('usuarios.index')}}"><img src="{!! asset('img/prop.png') !!}" width="24" class="imgsub" title="propietarios"><span>Propietarios</span></a></li>
                <li><a href="{{route('gastos.index')}}"><img src="{!! asset('img/gastos.png') !!}" width="24" class="imgsub" title="gastos"><span>Conceptos de Gasto</span></a></li>                
                <li><a href="{{route('facturas.index')}}"><img src="{!! asset('img/concil.png') !!}" width="24" class="imgsub" title="registro"><span>Registro de Gastos por mes</span></a></li>
                <li><a href="{{route('ver-ctasxc')}}"><img src="{!! asset('img/recibt.png') !!}" width="24" class="imgsub" title="recibos"><span>Recibos Pendientes</span></a></li>
                <li><a href="{{route('comunicados.index')}}"><img src="{!! asset('img/comu.png') !!}" width="24" class="imgsub" title="comunicados"><span>Comunicados</span></a></li>
                <li><a href="{{route('fondos.index')}}"><img src="{!! asset('img/finanzas.png') !!}" width="24" class="imgsub" title="finanzas"><span>Finanzas</span></a></li>
                <li><a href="{{route('ver-conciliar-pagos')}}"><img src="{!! asset('img/conciliar.png') !!}" width="20" class="imgsub" title="Conciliaciones"><span>Conciliaciones</span></a></li>
                <li><a href="{{route('gastos-proveedores')}}"><img src="{!! asset('img/ecta.png') !!}" width="24" class="imgsub" title="estado de cuenta"><span>Cuentas por Pagar</span></a></li>
                <li><a href="{{route('gastos-ctaprov')}}"><img src="{!! asset('img/prov.png') !!}" width="24" class="imgsub" title="cuenta proveedores"><span>Cuenta Proveedores</span></a></li>
                <li><a href="{{route('ctasinc')}}"><img src="{!! asset('img/incob.png') !!}" width="24" class="imgsub" title="cuenta incobrable"><span>Cuentas Incobrables</span></a></li>
            </ul>
        </li>
        <li><a href="{{route('show-pdf')}}" class="{{request()->routeIs('show-pdf') ? 'active' : ''}}"><img src="{!! asset('img/comusolid.png') !!}" width="24" title="comunicados"><span> Comunicados</span></a></li>
        <li><a href="{{route('fondos-finanzas')}}" class="{{request()->routeIs('fondos-finanzas') ? 'active' : ''}}"><img src="{!! asset('img/finanzas.png') !!}" width="24" title="finanzas"><span> Finanzas</span></a></li>
        <li><a href="{{route('usuarios-rpend')}}" class="{{request()->routeIs('usuarios-rpend') ? 'active' : ''}}"><img src="{!! asset('img/recib.png') !!}" width="24" title="recibos"><span> Recibos</span></a></li>
        <li><a href="{{route('usuarios-movimientos')}}" class="{{request()->routeIs('usuarios-movimientos') ? 'active' : ''}}"><img src="{!! asset('img/edocta.png') !!}" width="24" title="estado de cuenta"><span> Estado de Cuenta</span></a></li>
        <li><a href="{!! asset('buzon') !!}" class="{{request()->routeIs('buzon.index') ? 'active' : ''}}"><img src="{!! asset('img/correo.png') !!}" width="24" title="buzón"><span> Buzón de Sugerencias</span></a></li>
        <li><a href="{!! asset('perfil') !!}" class="{{request()->routeIs('perfil.index') ? 'active' : ''}}"><img src="{!! asset('img/usuar.png') !!}" width="24" title="perfil de usuario"><span> Mi Perfil</span></a></li>
    </ul>
</nav>