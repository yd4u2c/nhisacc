@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-12 col-md-11">
    		<div class="panel-heading">Service(s)</div>
    		<div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
                @endif




                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <div class="container col-md-12">
                   <div class="row">
                    <div class="col-md-9">
                        <center><a href="{{ url('/addservice') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new Service</a></center>
                    </div>
                    <div class="col-md-3">
                     <div class="form-group">
                      <input type="text" name="serach" id="serach" class="form-control" />
                  </div>
              </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
             <thead>
              <tr>
               <th class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
               <th class="sorting" data-sorting_type="asc" data-column_name="post_title" style="cursor: pointer">NHIS Code <span id="post_title_icon"></span></th>
               <th>Description</th>
               <th>Price</th>
           </tr>
       </thead>
       <tbody>
          @include('pagination_data2')
      </tbody>
  </table>
  <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
  <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
  <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
</div>
</div>

<script>
    $(document).ready(function(){

     function clear_icon()
     {
      $('#id_icon').html('');
      $('#post_title_icon').html('');
  }

  function fetch_data(page, sort_type, sort_by, query)
  {
      $.ajax({
        url:"/pagination/fetch_service?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
       success:function(data)
       {
        $('tbody').html('');
        $('tbody').html(data);
    }
})
  }

  $(document).on('keyup', '#serach', function(){
      var query = $('#serach').val();
      var column_name = $('#hidden_column_name').val();
      var sort_type = $('#hidden_sort_type').val();
      var page = $('#hidden_page').val();
      fetch_data(page, sort_type, column_name, query);
  });

  $(document).on('click', '.sorting', function(){
      var column_name = $(this).data('column_name');
      var order_type = $(this).data('sorting_type');
      var reverse_order = '';
      if(order_type == 'asc')
      {
       $(this).data('sorting_type', 'desc');
       reverse_order = 'desc';
       clear_icon();
       $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
   }
   if(order_type == 'desc')
   {
       $(this).data('sorting_type', 'asc');
       reverse_order = 'asc';
       clear_icon
       $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
   }
   $('#hidden_column_name').val(column_name);
   $('#hidden_sort_type').val(reverse_order);
   var page = $('#hidden_page').val();
   var query = $('#serach').val();
   fetch_data(page, reverse_order, column_name, query);
});

  $(document).on('click', '.pagination a', function(event){
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      $('#hidden_page').val(page);
      var column_name = $('#hidden_column_name').val();
      var sort_type = $('#hidden_sort_type').val();

      var query = $('#serach').val();

      $('li').removeClass('active');
      $(this).parent().addClass('active');
      fetch_data(page, sort_type, column_name, query);
  });

});
</script>




</div>

</div>


</div>
</div>
@endsection