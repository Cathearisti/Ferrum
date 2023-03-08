@extends('layouts.app')

@section('template_title')
Proveedor
@endsection

@section('content')
<div class="container">
    <main role="main" class="pb-3">
        <p>
            <a class="mdi mdi-cart-outline" id="iconoadd" href="{{ route('proveedor.create') }}"></a>
        </p>

        <table id="proveedores" class="table table-striped dt-responsive nowrap table" style="width:100%">
            <thead>
                <tr>


                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Tipo Persona</th>
                    <th>Saldo Pendiente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($proveedores as $proveedor)
                <tr>

                    <td>{{ $proveedor->cedula }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->email }}</td>
                    @if ($proveedor->tipo_persona==1)
                    <td>Juridico</td>
                    @else
                    <td>Natural</td>
                    @endif

                    <td>0</td>
                   

                    <td>
                        <?php if ($proveedor->estado == 1) {
                            echo 'Activo';
                        } else {
                            echo 'Inactivo';
                        }  ?></td>
                    
                    <td>

                        <a href="{{ url('/proveedor/'.$proveedor->id.'/edit') }}"><button class="mdi mdi-lead-pencil"></button></a>

                        <!-- Button trigger modalvisualizar facturas -->
                        <a href="{{ route('proveedor.show', $proveedor->id) }}"><button class="mdi mdi-format-align-left"></button></a>

                        <a data-toggle="modal" data-target="#eliminar"><button class="mdi mdi-trash-can-outline"></button></a>

                        <form action="{{ url('/proveedor/'.$proveedor->id) }}" method="POST">


                            @csrf
                            {{ method_field('DELETE') }}
                            

                            <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Proveedor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro que desea eliminar el proveedor?
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Sí" class="btn btn-primary btn-lg active" role="button" aria-hidden="true">

                                            <a href="{{ route('proveedor.index') }}" class="btn btn-primary btn-lg active" role="button" data-dismiss="modal">No</a>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


</div>


{!! $proveedores->links() !!}


<!-- scripts -->

<script>
    $(document).ready(function() {
        $('#proveedores').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>




@endsection