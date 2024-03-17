<!DOCTYPE html>
<html>
<head>
    <title>عملیات CRUD با استفاده از Datatable و Ajax در لاراول 5.8 | تجاری اپ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> -->


    <link href="{{ asset('css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }} " rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }} " rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }} " rel="stylesheet">


    <script src="{{ asset('js/jquery.js') }}"></script> 
    <script src="{{ asset('js/jquery.validate.js') }}"></script> 
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> 
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script> 
    <script src="{{ asset('js/select2.min.js') }}"></script> 


 
    <style>
        body {
            direction: rtl;
            text-align: right;
            background-color: #FFF5EE;
        }
        .container h1 {
            font-size: 2rem;
            text-align: center;
            margin: 50px 0;
        }
    </style>
</head>
<body>
 
<div class="container">
    <h1>عملیات CRUD با استفاده از Datatable و Ajax در لاراول 5.8 - تجاری اپ</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewArticle"> ایجاد مقاله جدید</a>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>ردیف</th>
            <th>نام</th>
            <th>جزئیات </th>
            <th width="280px">عملیات</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
 
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="articleForm" name="articleForm" class="form-horizontal">
                    <input type="hidden" name="article_id" id="article_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">عنوان مقاله</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="عنوان را وارد کنید" value="" maxlength="50" required="">
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="col-sm-4 control-label">جزئیات مقاله</label>
                        <div class="col-sm-12">
                            <textarea id="des" name="des" required="" placeholder="جزئیات مقاله را وارد کنید" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">دسته بندی</label>
                        <div class="col-sm-12">
                            <select id="category" name="category" class="form-control">
                                <option value="">انتخاب دسته بندی</option>
                                <!-- Add options dynamically using JavaScript or fetch them from the server -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                            <!-- No options initially -->
                        </select>
                    </div>
 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
</body>
 
<script type="text/javascript">

    $(document).ready(function() {
        // Initialize the Select2 combo box
        $('#category').select2();

        // Fetch category options dynamically
        $.ajax({
            url: '{{ route('categories.index') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {

                console.log("category are:" , data);
                // Populate the select element with the received data
                var options = '';
                $.each(data.categories, function(key, category) {
                   
                    options += '<option value="' + category.id + '">' + category.name + '</option>';
                });
                $('#category').html(options);
            }
        });

        // Fetch tags using AJAX
        $.ajax({
            url: "{{ route('tags.index') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                var tags = response.tags;
                var select = $('#tags');
                select.empty();
                $.each(tags, function(key, value) {
                    select.append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
        
    });

    $(function () {
 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        var table = $('.data-table').DataTable({
            "oLanguage":{
                "sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
                "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                "sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
                "sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "نمایش _MENU_ رکورد",
                "sLoadingRecords": "در حال بارگزاری...",
                "sProcessing":     "در حال پردازش...",
                "sSearch":         "جستجو:",
                "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
                "oPaginate": {
                    "sFirst":    "ابتدا",
                    "sLast":     "انتها",
                    "sNext":     "بعدی",
                    "sPrevious": "قبلی"
                },
                "oAria": {
                    "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
                    "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                }
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('articles.datatable') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'des', name: 'des'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
 
        $('#createNewArticle').click(function () {
            $('#saveBtn').val("create-article");
            $('#article_id').val('');
            $('#articleForm').trigger("reset");
            $('#modelHeading').html("ایحاد مقاله جدید");
            $('#ajaxModel').modal('show');
        });
 
        $('body').on('click', '.editArticle', function () {
            //alert($(this).data('id'));
            var article_id = $(this).data('id');
            
            $.get("/dashboard/article/"+ article_id , function (data) {
                $('#modelHeading').html("ویرایش مقاله");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#article_id').val(data.id);
                $('#title').val(data.title);                
                $('#des').val(data.des);
                //$('#category').val(data.category_id);
            });
                
        });
 
        $('#saveBtn').click(function (e) {

            //alert($("#category").val());
            //console.log("data to save:" ,$('#articleForm').serialize());
            e.preventDefault();
            $(this).html('ثبت..');
 
            $.ajax({
                data: $('#articleForm').serialize(),
                url: " {{ route('article.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
 
                    $('#articleForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
 
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('ذخیره تغییرات');
                }
            });
        });
 
        $('body').on('click', '.deleteArticle', function () {
 
            var article_id = $(this).data("id");
            confirm("آیا شما می خواهید این مقاله را حذف کنید؟");
 
            $.ajax({
                type: "DELETE",
                url: "/dashboard/article/"+ article_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
 
    });
</script>
</html>