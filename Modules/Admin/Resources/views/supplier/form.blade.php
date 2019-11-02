<form action="" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Tên nhà cung cấp:</label>
        <input type="text" class="form-control" placeholder="Name nhà cung cấp"
               value="{{ old('s_name',isset($supplier->s_name) ? $supplier->s_name  : '') }}" name="s_name">
        @if($errors->has('s_name'))
            <span class="error-text">
                {{$errors->first('s_name')}}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="name">Email nhà cung cấp:</label>
        <input type="email" class="form-control" placeholder="Email nhà cung cấp"
               value="{{ old('s_email',isset($supplier->s_email) ? $supplier->s_email  : '') }}" name="s_email">
        @if($errors->has('s_email'))
            <span class="error-text">
                {{$errors->first('s_email')}}
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="name">Số điện thoại:</label>
        <input type="number" class="form-control" placeholder="0986420994"
               value="{{ old('s_phone',isset($supplier->s_phone) ? $supplier->s_phone : '') }}" name="s_phone">
        @if($errors->has('s_phone'))
            <span class="error-text">
                {{$errors->first('s_phone')}}
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Số Fax:</label>
        <input type="text" class="form-control" placeholder="+84333444"
               value="{{ old('s_fax',isset($supplier->s_fax) ? $supplier->s_fax : '') }}" name="s_fax">
        @if($errors->has('s_fax'))
            <span class="error-text">
                {{$errors->first('s_fax')}}
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Website:</label>
        <input type="text" class="form-control" placeholder="google.com.vn"
               value="{{ old('s_website',isset($supplier->s_website) ? $supplier->s_website : '') }}" name="s_website">
        @if($errors->has('s_website'))
            <span class="error-text">
                {{$errors->first('s_website')}}
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-success">Lưu thông tin</button>
</form>