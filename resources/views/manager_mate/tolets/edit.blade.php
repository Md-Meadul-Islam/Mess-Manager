<div class="row edittoletform" style="position: absolute; top:0; right:5px; width:20rem;">   
    <div class="col-12">
        <input type="hidden" name="" id="toletid" value="{{$tolets->id}}">
      <div class="card">
        <a href="javascript:void(0)" class="d-flex justify-content-end hideeditmodal">❌</a>
        <div class="card-body">
          <div class="col-12">
            <label for="title" class="form-label"><strong>Title</strong><span
                style="color:red;padding-left:5px">*</span></label>
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend"><i
                  class="fa-solid fa-signature"></i></span>
              <input type="text" name="title"value="{{$tolets->title}}" class="form-control" id="title" required>
            </div>
          </div>
          <div class="col-12">
            <label for="month" class="form-label"><strong>{{__('Month From')}}</strong><span
                style="color:red;padding-left:5px">*</span></label>
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend">📅</span>
              <select name="month" id="month" class="form-select">
                @for ($i = 0; $i <6; $i++) @php $date=now()->addMonths(($i));
                  @endphp
                  <option value="{{$date->format('M-Y')}}" <?php if ( $date->format('M-Y') == $tolets->from_month
                    )
                    echo "selected" ?>>
                    {{$date->format('M-Y')}}
                  </option>
                  @endfor
              </select>
            </div>
          </div>
          <div class="col-12">
            <label for="details" class="form-label"><strong>{{__('Details')}}</strong><span
                style="color:red;padding-left:5px">*</span></label>
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend">📜</span>
              <textarea name="details" id="details" class="form-control"required>{{$tolets->details}}</textarea>
            </div>
          </div>
          <div class="col-12">
            <label for="address" class="form-label"><strong>{{__('Address')}}</strong><span
                style="color:red;padding-left:5px">*</span></label>
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend">🏖</span>
              <textarea name="address" id="address" class="form-control" required>{{$tolets->address}}</textarea>
            </div>
          </div>
          <div class="col-12">
            <label for="contact" class="form-label"><strong>{{__('Contact')}}</strong> <span
                style="color:red;padding-left:5px">*</span></label>
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend">📠</span>
              <input type="text" name="contact" value="{{$tolets->contacts}}" class="form-control" id="contact" required>
            </div>
          </div>
          <div class="col-12">
            <label for="photo1" class="form-label"><strong>{{__('Room Photo 1')}}</strong> <span
                style="color: red; font-size:10px; align-items:right">Max-Size: 3MB</span></label>
                <img src="{{ asset('storage/tolet_img/' . $tolets->photo_1) }}" alt="photo_1" style="width:100px;height:50px">
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend">🕍</span>
              <input type="file" name="photo1" class="form-control" id="photo1" accept="image/*">
            </div>
          </div>
          <div class="col-12">
            <label for="photo2" class="form-label"><strong>{{__('Room Photo 2')}}</strong> <span
                style="color: red; font-size:10px; align-items:right">Max-Size: 3MB</span></label>
                <img src="{{ asset('storage/tolet_img/' . $tolets->photo_2) }}" alt="photo_2" style="width:100px;height:50px">
            <div class="input-group">
              <span class="input-group-text" id="inputGroupPrepend">🕍</span>
              <input type="file" name="photo2" class="form-control" id="photo2" accept="image/*">
            </div>
          </div>
          <div class="col-12 p-2 d-flex justify-content-center">
            <button class="btn btn-success btn-outline-warning w-50 updateBtn" type="submit">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>