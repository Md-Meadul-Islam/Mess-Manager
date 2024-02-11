<style>
  .tolet_table {
    overflow: auto;
    scrollbar-color: rgb(78, 105, 95) transparent;
  }

  .table thead tr th {
    background-color: rgb(78, 105, 95);
  }

  .table {
    border-collapse: collapse;
  }

  /* Webkit (Chrome, Safari, newer versions of Opera) */
  .tolet_table::-webkit-scrollbar {
    height: 5px;
  }

  .tolet_table::-webkit-scrollbar-thumb {
    background-color: rgb(78, 105, 95);
    border-radius: 5px;
    height: 5px;
  }

  /* Firefox */
  .tolet_table::-moz-scrollbar {
    height: 5px;
  }

  .tolet_table::-moz-scrollbar-thumb {
    background-color: rgb(78, 105, 95);
    border-radius: 5px;
    height: 5px;
  }

  /* Microsoft Edge and IE */
  .tolet_table::-ms-scrollbar {
    height: 5px;
  }

  .tolet_table::-ms-scrollbar-thumb {
    background-color: rgb(78, 105, 95);
    border-radius: 5px;
    height: 5px;
  }

  .tolet_table::-ms-scrollbar-track {
    background-color: transparent;
  }
</style>
<div class="col-12">
  <div class="card h-100">
    <h5 class="card-header">View Your To-Let</h5>
    <div class="card-body tolet_table">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>From Month</th>
            <th>Details</th>
            <th>Address</th>
            <th>Contacts</th>
            <th>Photo_1</th>
            <th>Photo_2</th>
            <th>Created_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tolets as $tolet)
          <tr>
            <td>{{$tolet->title}}</td>
            <td>{{$tolet->from_month}}</td>
            <td>{{$tolet->details}}</td>
            <td>{{$tolet->address}}</td>
            <td>{{$tolet->contacts}}</td>
            <td><img src="{{ asset('storage/tolet_img/' . $tolet->photo_1) }}" class="img-fluid files"
                style="width:200px; height:100px;" alt="First slide"></td>
            <td><img src="{{ asset('storage/tolet_img/' . $tolet->photo_2) }}" class="img-fluid files"
                style="width:200px; height:100px;" alt="Second slide"></td>
            <td>{{$tolet->created_at}}</td>
            <td class="justify-content-center align-items-center">
              <div>
                <a href="javascript:void(0)" class="btn btn-sm btn-success m-1 w-100 edittolet"
                  data-id="{{$tolet->id}}">✍</a>
                  <div class="position-relative edittoletdiv"></div>
              </div>
              <a href="javascript:void(0)" class="btn btn-sm btn-danger m-1 w-100 deletetolet"
                data-id="{{$tolet->id}}">🗑</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>