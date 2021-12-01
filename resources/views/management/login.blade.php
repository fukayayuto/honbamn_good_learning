
<p></p>
<h1>ログイン</h1>
<p></p>
 
{{-- エラーメッセージ --}}
@if (isset($login_error))
  <div id="error_explanation" class="text-danger">
    <ul>
      <li>メールアドレスまたはパスワードが一致しません。</li>
    </ul>
  </div>
@endif
<p></p>
 
{{-- フォーム --}}
<form action="{{ url('admin_login') }}" method="post">
  @csrf  
  <div class="form-group">
    <label for="name">名前</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>     
  <div class="form-group">
    <label for="user_password">パスワード</label>
    <input type="password" class="form-control" id="user_password" name="password">
  </div>     
  <input type="submit" value="ログインする" class="btn btn-primary">  
</form>  
<p><br></p>