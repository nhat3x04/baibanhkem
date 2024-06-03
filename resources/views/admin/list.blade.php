@extends('layoutadmin.master')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if (isset($products))
                        @php
                        $products=$products
                            @endphp
                            @endif  
                        @foreach ($products as $product)
                    <form action="{{ route('products.destroy',['id'=>$product->id])}}" method="post">
                        @csrf
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          
                        @method('delete')
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>unit_price</th>
                                <th>promotion_price</th>
                                <th>description</th>
                                <th>unit</th>
                                <th>new</th>
                                <th>image</th>
                                <th style="witdh:90px;">Chức năng</th>

                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>{{$product -> id}}</td>
                                <td>{{$product -> name}}</td>
                                <td>{{$product -> unit_price}}</td>
                                <td>{{$product -> promotion_price}}</td>
                                <td>{{$product ->description}}</td>
                                <td>{{$product ->unit}}</td>
                                <td>{{$product ->new}}</td>
                                <td><img src="/source/image/product/{{$product->image}}" alt="" witdh="80px"height="80px"></td>

                                
                                <td class="center"><i class="fa fa-pencil fa-fw"></i><a style="background-color:yellow; min-width:90px; border:1px black solid;" href="{{ route('products.edit', ['id' => $product->id]) }}"> Edit</a><br>
                                <i class="fa fa-trash-o  fa-fw"><input style="background-color:red;min-width:50px;" type="submit" value="Delete"></td>
                            </tr>
                           
                        </tbody>
                        @endforeach
                        
                    </table>
                    {{ $products->onEachSide(7)->links() }}
                    </form>
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    @endsection

    <style>
        th, td{
            text-align: center;
        }
        th{
            width :80px;
        }
        .fa{
            /* color: white */
        }
        </style>