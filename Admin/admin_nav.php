
<style>
nav {
    color: white;
    background-color: #142f61;
}

.nav-link,
#logout {
    color: white !important;
    font-family: cursive;
}

navbar-nav a:hover {

    color: rgb(85, 85, 74) !important;
    font-weight: bold;
    font-family: cursive;
    /* font-size: large; */
    border-radius: 2rem;
}

li a:visited {
    color: #DEF2F1;
    /* text-color */
}

li a:hover,
#logout:hover, li a.active {
    background-color: #def2f1;
    color: rgb(85, 85, 74) !important;
    /* font-weight: bold; */
    font-family: cursive;
    /* font-size: large; */
    border-radius: 2rem;

}

/* @media screen and (max-width: 992px) {
  .nav-item:hover{
  
    width: 200px;
   
  } }*/



.dropdown-item {
    color: #142f61;
}

#shopname {
    font-family: cursive;
}

#logout {
    border-radius: 2rem;
}

.dropdown-item {
    background-color: #142f61
}

nav{
    /* background-color: #142f61; */ 
    background-color:#142f61;
    
}


  li a:visited {
    color: #DEF2F1;         /* text-color */

  }
  
 li a:hover {
    background-color:#ffffff;
}




</style>


<nav class="navbar navbar-expand-lg navbar p-0">
  <a class="navbar-brand" href="#"><img src="Assets/Images/logo_footer.png" width="" height="50" class="d-inline-block align-top mx-3 m-n2" alt=""> <span id="shopname" class="fw-bold text-white px-3">QuickFIX<sub>Admin</sub></span></a>

  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="material-icons-outlined">
      ---
    </i>
  </button>

  <div class="collapse  text-center navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav  ml-auto">
      <li class="nav-item   px-3">
        <a class="nav-link " href="dashboard.php">DashBoard </a>
      </li>
      <li class="nav-item  px-3">
        <a class="nav-link  " href="customerDetailsTable.php">Customers </a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link " href="tradesmanDetailsTable.php">Tradesmen</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link " href="service.php">Services</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link " href="hiring.php">Hirings</a>
      </li>
      <li class="nav-item  px-3">
        <a class="nav-link btn  " type="submit" name="logout" href="logout_admin.php">Logout </a>
      </li>

    </ul>

  </div>
</nav>


<script>
    const currentLocation = location.href
    const menuItem = document.querySelectorAll('li a')
    const menuLength = menuItem.length
    for(let i=0; i<menuLength; i++){
        if (menuItem[i].href === currentLocation){
            menuItem[i].className += "active"
        }
    }
</script>