@extends('layouts.app')
@section('content')

    <main class="container">
        <section>
            <form method="post" action="{{ route('penyelenggara.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="titlebar">
                <h1>Add Product</h1>
                <button>Save</button>
            </div>
            <div class="card">
               <div>
                    <label>Nama</label>
                    <input type="text" name="name">
                    <label>Description (optional)</label>
                    <textarea cols="10" rows="5" ></textarea>
                    <label>Add Image</label>
                    <img src="" alt="" class="img-product" />
                    <input type="file" >
                </div>
               <div>
                    <label>Category</label>
                    <select  name="" id="" >
                        <option value="" >Email Subscription</option>
                    </select>
                    <hr>
                    <label>Inventory</label>
                    <input type="text" class="input" >
                    <hr>
                    <label>Price</label>
                    <input type="text" class="input" >
               </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <button>Save</button>
                
            </div>
        </section>
    </main>

@endsection