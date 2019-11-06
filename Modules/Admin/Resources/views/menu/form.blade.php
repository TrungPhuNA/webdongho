<form action="" method="POST">
    @csrf
    <div class="form-group">
        <label for="m_name">Tên menu:</label>
        <input type="text" class="form-control" placeholder="Tên menu" value="{{ old('m_name',isset($menu->m_name) ? $menu->m_name  : '') }}" name="m_name">
        @if($errors->has('m_name'))
            <span class="error-text">
                {{$errors->first('m_name')}}
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-success">Lưu thông tin</button>
</form>