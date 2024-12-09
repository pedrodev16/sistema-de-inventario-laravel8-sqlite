 <div class="sidebar-menu">
     <div class="sidebar-header">
         <div class="logo">
             <a href="index.html">C/INVENTARIO
                 {{-- <img src="assets/images/icon/logo.png" alt="logo"> --}}
             </a>
         </div>
     </div>
     <div class="main-menu">
         <div class="menu-inner">
             <nav>
                 <ul class="metismenu" id="menu">
                     <li class="active">
                         <a href="{{ route('dashboard') }}"><i class="ti-dashboard"></i><span>dashboard</span></a>

                     </li>
                     <li class="active">
                         <a href="{{ route('productos.index') }}"><i class="ti-package"></i><span>Productos</span></a>
                     </li>
                     <li class="active">
                         <a href="{{ route('carrito.index') }}"><i class="ti-shopping-cart"></i><span>Carrito</span></a>
                     </li>
                     <li class="active">
                         <a href="{{ route('stock.index') }}"><i class="ti-agenda"></i><span>Ventas</span></a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i>
                             <span>Administración</span></a>
                         <ul class="collapse">
                             <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                             <li><a href="{{ route('categorias.index') }}">Categorias</a></li>
                             <li><a href="{{ route('marcas.index') }}">Marcas</a></li>
                             <li><a href="{{ route('proveedor.index') }}">Proveedores</a></li>
                             <li><a href="{{ route('producto.index') }}">Productos</a></li>
                             <li>
                                 <a href="{{ route('stock.index') }}">Stock</a>

                             </li>
                         </ul>
                     </li>
                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                             <span>Configuración</span></a>
                         <ul class="collapse">
                             <li><a href="{{ route('empresa.index') }}">Configuración de Empresa</a></li>


                         </ul>
                     </li>

             </nav>
         </div>
     </div>
 </div>
 <!-- sidebar menu area end -->
