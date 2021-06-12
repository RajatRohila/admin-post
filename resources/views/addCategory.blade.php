<!DOCTYPE html>
 <html lang="en">
<head>
	<meta charset="utf-8">
	<title>AdminPost</title>
	<link rel="stylesheet" media="all" href="css/style.css">
</head>
<body>
    @if(Session::has("error"))
    <div class="alert alert-success">
        {{ Session::get('error') }}
        @php
            Session::forget('error');
        @endphp
    </div>
    @endif
    @if(Session::has("success"))
    <div class="alert alert-success">
        Success: {{ Session::get('success') }}
        @php
            Session::forget('success');
        @endphp
    </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
<style>
html, body {font-family: Arial, Helvetica, sans-serif;min-height: 100%;}

/* Full-width input fields */
.formIn {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #008bc4;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 15%;
}

button:hover {
  opacity: 0.8;
}

.container {
  padding: 16px;
}

span.psw {
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
}
</style>
<div class="container" style="margin: 0px;width:100%;height:100%">
     <form action="/insertCategory" method="post" style="width:50%">
        @csrf
    <div class="container" style="text-align: center;position: relative;left: 70px;">
        <div>
            <label for="category"><span style="display: block; position: relative; right: 12%;"><b>Category</b></span></label>
            <input type="text" class="formIn" placeholder="Enter Category" name="category" @if(isset($categoryData)) value="{{$categoryData->category_name}}" @endif required>
        </div>
        <div>
            <button type="submit">Add</button>
        </div>
        <input type="hidden" name="categoryId" @if(isset($categoryData)) value={{$categoryData->id}} @endif>
    </div>
    </form>
</div>
</body>
</html>