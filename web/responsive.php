<div class="container mt-5">
    <!-- heading will be here -->
    <div class="row">
    <div class="col-sm">
        <h1>Bootstrap Sample Page with Form</h1>
    </div>
    </div>  

    <!-- alert -->
    <div class="row">
    <div class="col-sm">
        <div class="alert alert-success">
            <strong>Good day!</strong> This is an example alert. Visit <a href="https://codeofaninja.com/" target="_blank">codeofaninja.com</a>!
        </div>
    </div>
    </div>

    <!-- table will be here -->
    <div class="row">
    <div class="col-sm">
          
        <table class='table table-hover'>
  
            <tr>
                <td>Name</td>
                <td></td>
            </tr>
  
            <tr>
                <td>Contact Number</td>
                <td></td>
            </tr>
  
            <tr>
                <td>Address</td>
                <td></td>
            </tr>
  
            <tr>
                <td>List</td>
                <td></td>
            </tr>
  
            <tr>
                <td></td>
                <td></td>
            </tr>
  
        </table>
              
    </div>
    </div>

    <!-- FORM -->
    <form action='#' method='post'>
    <table class='table table-hover'>
  
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Contact Number</td>
            <td><input type='text' name='contact_number' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Address</td>
            <td><textarea name='address' class='form-control'></textarea></td>
        </tr>
  
        <tr>
            <td>List</td>
            <td>
                <select name='list_id' class='form-control'>
                    <option value='1'>List One</option>
                    <option value='2'>List Two</option>
                    <option value='3'>List Three</option>
                </select>
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> Submit
                </button>
            </td>
        </tr>
  
    </table>
    </form>
</div>