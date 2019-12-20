<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group">
                <label for="pro_name">Họ tên:</label>
                <input type="text" class="form-control" placeholder="Họ tên" value="{{ old('name',isset($admin->name) ? $admin->name  : '') }}" name="name">
                @if($errors->has('name'))
                    <span class="error-text">
                        {{$errors->first('name')}}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="pro_name">Email:</label>
                <input type="email" class="form-control" placeholder="Họ tên" value="{{ old('email',isset($admin->email) ? $admin->email  : '') }}" name="email">
                @if($errors->has('email'))
                    <span class="error-text">
                        {{$errors->first('email')}}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="pro_name">Số điện thoại:</label>
                <input type="number" class="form-control" placeholder="Số điện thoại" value="{{ old('phone',isset($admin->phone) ? $admin->phone  : '') }}" name="phone">
                @if($errors->has('phone'))
                    <span class="error-text">
                        {{$errors->first('phone')}}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="pro_name">Mật khẩu:</label>
                <input type="password" class="form-control" placeholder="********" {{ !isset($admin) ? 'required' : '' }} value="" name="password">
                @if($errors->has('password'))
                    <span class="error-text">
                        {{$errors->first('password')}}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Lưu thông tin</button>
        </div>
    </div>

</form>
