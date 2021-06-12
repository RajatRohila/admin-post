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
        Errors: {{ Session::get('error') }}
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
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: 25px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
}
</style>
<script>
    var currentId = {{Session::get('user_id')}};
    function editCategory(userId, parentId){
        if(parentId == currentId){
            window.location = "addCategory/"+userId;
        }else{
            alert("You can edit only your's cayegory");
        }
    }
    function deleteCategory(userId, parentId){
        if(parentId != currentId){
            alert("You can delete only own users");
        }else{
            window.location = "deleteCategory/"+userId;
        }
    }
</script>
<div class="container" style="margin: 0px;width:100%;height:100%;">
<a href="addCategory" style = "color:white; text-decoration: underline; cursor:pointer;background-color:blue;font-size: 25px;">Click here to add new category</a>
<table id="customers">
  <tr>
    <th>Category Name</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
    @foreach($categoryData as $category)
        <tr>
            <td>{{$category['category_name']}}</td>
            <td><a onclick="editCategory({{$category['id']}}, {{$category['user_id']}})" style="color:blue; text-decoration: underline; cursor:pointer;">edit</a></td>
            <td><a onclick="deleteCategory({{$category['id']}}, {{$category['user_id']}})" style="color:red; text-decoration: underline; cursor:pointer;">delete</a></td>
        </tr>
     @endforeach
</table>
<a href="viewCategory" style = "color:white; text-decoration: underline; cursor:pointer;background-color:blue;font-size: 25px;">Click here to view Categories</a>
</div>
</body>
</html>