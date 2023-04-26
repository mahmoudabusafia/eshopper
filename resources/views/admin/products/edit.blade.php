@extends('admin.layouts.layout')

@section('content')

    <div class="container">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">Create Product</h4>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3">{{ __('Image') }}</label>
                                        <div class="col-lg-6">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper"
                                                     style="background-image: url({{ $product->image_url }});
                                                            width: 120px;
                                                            height: 120px;"></div>
                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Add Image">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                                    <input type="hidden" name="image_remove"/>
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Remove Image">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Product Name') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('name')  is-invalid @enderror"
                                                   name="name" value="{{ old('name', $product->name) }}"
                                                   placeholder="product name..."/>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Category') }}</label>
                                        <div class="col-lg-6">
                                            <select name="category_id" id="parent_id"
                                                    class="form-control form-control-solid">
                                                <option hidden="hidden"></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @if($category->id == old('id', $product->category_id)) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Price') }}</label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control form-control-solid @error('price')  is-invalid @enderror"
                                                   name="price" value="{{ old('price', $product->price) }}"
                                                   placeholder="price..."/>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Quantity') }}</label>
                                        <div class="col-lg-6">
                                            <input type="number"
                                                   class="form-control form-control-solid @error('quantity')  is-invalid @enderror"
                                                   name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                                   placeholder="quantity..."/>
                                            @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- {{ dd($product->variants) }}  --}}
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3">{{ __('Product Features') }}</label>
                                        <div class="form-group col ">
{{--                                            <div class="form-group row ">--}}
{{--                                                <label class="col-form-label col-lg-1">{{ __('Sizes') }}</label>--}}
{{--                                                <div class="col-8 col-form-label">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        @foreach($product->variants as $var)--}}
{{--                                                        @if($var->type == 'size')--}}
{{--                                                        <label class="checkbox">--}}
{{--                                                            <input type="checkbox" name="variants[sizes][]" value="{{$var->value}}"  checked />--}}
{{--                                                            <span></span>--}}
{{--                                                            {{ $var->value }}--}}
{{--                                                        </label>--}}
{{--                                                        @endif--}}
{{--                                                        @endforeach--}}
{{--                                                        <label class="checkbox">--}}
{{--                                                            <input type="checkbox" name="variants[sizes][]" value="s" />--}}
{{--                                                            <span></span>--}}
{{--                                                            s--}}
{{--                                                        </label>--}}
{{--                                                        <label class="checkbox">--}}
{{--                                                            <input type="checkbox" name="variants[sizes][]" value="m" />--}}
{{--                                                            <span></span>--}}
{{--                                                            m--}}
{{--                                                        </label>--}}
{{--                                                        <label class="checkbox">--}}
{{--                                                            <input type="checkbox" name="variants[sizes][]" value="l" />--}}
{{--                                                            <span></span>--}}
{{--                                                            l--}}
{{--                                                        </label>--}}
{{--                                                        <label class="checkbox">--}}
{{--                                                            <input type="checkbox" name="variants[sizes][]" value="xl"/>--}}
{{--                                                            <span></span>--}}
{{--                                                            xl--}}
{{--                                                        </label>--}}
{{--                                                        <label class="checkbox">--}}
{{--                                                            <input type="checkbox" name="variants[sizes][]" value="xxl"/>--}}
{{--                                                            <span></span>--}}
{{--                                                            xxl--}}
{{--                                                        </label>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="form-group row ">
                                                <label class="col-form-label col-lg-2">{{ __('Variants') }}</label>
                                                <div class="col-8 col-form-label">
                                                    <div class="form-group">
{{--                                                        <input type="text" name="type" id="type" placeholder="type">--}}
                                                        <select name="select" id="select">
                                                            <option value="size">size</option>
                                                            <option value="color">color</option>
                                                        </select>
                                                        <input type="text" name="value" id="value" placeholder="value">
                                                        <button id="add-button">Add</button>
                                                    </div>
                                                    <div class="form-group" id="output">
                                                        @foreach($product->variants as $var)
                                                            <div class="form-group row delete">
                                                                <i class="ki ki-close" style="color: red" id="close"></i>&nbsp;&nbsp;
                                                                <label>Type:&nbsp;&nbsp; {{ $var->type }} &nbsp; &nbsp; &nbsp;</label>
                                                                <label>Value:&nbsp;&nbsp;&nbsp;{{ $var->value }}</label>
                                                                <input type="hidden" name="info-del" data-prod_id="{{$product->id}}" data-type="{{ $var->type }}" data-value="{{ $var->value }}" data-var_id="{{ $var->id }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-form-label col-lg-3">{{ __('Description') }}</label>
                                        <div class="col-lg-6">
                                            <textarea type="text"
                                                      class="form-control form-control-solid @error('description')  is-invalid @enderror"
                                                      name="description" value="{{ old('description') }}"
                                                      placeholder="write a short description...">{{ $product->description }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Status</label>
                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="radio" name="status" value="active" @if($product->status !== 'draft') checked="checked" @endif/>
                                                    <span></span>
                                                    Active
                                                </label>
                                                <label class="checkbox">
                                                    <input type="radio" name="status" value="draft" @if($product->status == 'draft') checked="checked" @endif/>
                                                    <span></span>
                                                    Draft
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <button type="submit" class="btn btn-primary font-weight-bold mr-2">Submit
                                            </button>
                                            <button type="submit" class="btn btn-light-primary font-weight-bold">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>


    <script>
        // Get references to the input field, add button, and output div
        // const type = document.getElementById('type');
        const value = document.getElementById('value');
        const select = document.getElementById('select');
        const addButton = document.getElementById('add-button');
        const outputDiv = document.getElementById('output');
        const close = document.getElementById('close');
        const delDiv = document.querySelectorAll('.delete');
        const closes = document.querySelectorAll('#close');


        delDiv.forEach( div => {
            div.children[0].addEventListener('click', (event) => {
                if (event.target.id === 'close') {
                    // Do something when the icon is clicked
                    console.log('Icon clicked!');

                let prod_id = div.children[3].dataset.prod_id;
                let var_id = div.children[3].dataset.var_id;
                let prod_type = div.children[3].dataset.type;
                let prod_value = div.children[3].dataset.value;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('deleteVariant') }}',
                    dataType : 'json',
                    type: 'POST',
                    data: {
                        prod_id: prod_id,
                        var_id: var_id,
                        prod_type: prod_type,
                        prod_value: prod_value,
                    },
                    success:function(response) {
                        toastr.success('the variant of product was deleted!', 'Variant Deleted!');
                        console.log(response);
                    }
                });
                console.log(prod_id,prod_type,prod_value)
                div.remove();
                }
            });
        });

        // Add a click event listener to the add button
        addButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log(value.value,select.value);

            if(value.value !== ''){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('addVariant') }}',
                dataType : 'json',
                type: 'POST',
                data: {
                    prod_id: {{ $product->id }},
                    prod_type: select.value,
                    prod_value: value.value,
                },
                success:function(response) {
                    console.log(response.id)
                    // Get the parent element
                    let parentDiv = document.createElement('div');
                    parentDiv.classList.add('form-group', 'row', 'delete');

// Create the icon element
                    let icon = document.createElement('i');
                    icon.classList.add('ki', 'ki-close');
                    icon.style.color = 'red';
                    icon.id = 'close';
                    parentDiv.appendChild(icon);

// Create the first label element
                    let typeLabel = document.createElement('label');
                    typeLabel.innerHTML = 'Type:&nbsp;&nbsp;' + response.type + '&nbsp;&nbsp;&nbsp;';
                    parentDiv.appendChild(typeLabel);

// Create the second label element
                    let valueLabel = document.createElement('label');
                    valueLabel.innerHTML = 'Value:&nbsp;&nbsp;&nbsp;' + response.value;
                    parentDiv.appendChild(valueLabel);

// Create the hidden input element
                    let hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'info-del';
                    hiddenInput.dataset.prod_id = response.product_id;
                    hiddenInput.dataset.type = response.type;
                    hiddenInput.dataset.value = response.value;
                    hiddenInput.dataset.var_id = response.id;
                    parentDiv.appendChild(hiddenInput);

                    // Append the new paragraph element to the output div
                    outputDiv.appendChild(parentDiv);
                    // Clear the input field
                    value.value = '';
                }
            });

            }else {
                toastr.error('the value input cannot be empty!', 'Add Value Error!');
            }


        });

        // addButton.addEventListener('click', function(e) {
        //     e.preventDefault();
        //     // Get the value of the input field
        //     // const typeValue = type.value;
        //     const valueValue = value.value;
        //     const selectValue = select.value;
        //
        //     const label = document.createElement('label');
        //     label.setAttribute('class', 'checkbox');
        //     label.setAttribute('id', 'fet');
        //
        //     const input = document.createElement('input');
        //     input.setAttribute('type', 'checkbox');
        //     input.setAttribute('name', 'variants[' + selectValue + '][]');
        //     input.setAttribute('value', valueValue);
        //     input.setAttribute('checked', 'checked');
        //
        //     const span = document.createElement('span');
        //
        //     const text = document.createTextNode(valueValue);
        //
        //     label.appendChild(input);
        //     label.appendChild(span);
        //     label.appendChild(text);
        //
        //     // Append the new paragraph element to the output div
        //     if(valueValue !== ''){
        //         outputDiv.appendChild(label);
        //         // Clear the input field
        //         value.value = '';
        //     }else {
        //         // alert('the type and value input cannot be empty!')
        //         toastr.error('the value input cannot be empty!', 'Add Value Error!');
        //     }
        // });



    </script>

@endsection

@push('script')
    let avatar1 = new KTImageInput('kt_image_1');
@endpush
