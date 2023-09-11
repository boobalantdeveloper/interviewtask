<div class="leftpanel">
    
    <div class="logopanel">
        <h4> Dashboard </h4>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="{{ asset('images/photos/loggeduser.png')}}" class="media-object">
                
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Menu</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class="@if(request()->is('/')) active @endif"><a href=""><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        
        <li class="nav-parent @if(request()->is('product/*')) nav-active @endif"><a href=""><i class="fa fa-gears fa-fw"></i> <span>Products</span></a>
          <ul class="children" style="@if(request()->is('product/*')) display: block; @endif">
            <li><a href="{{route('product.create-product')}}">@if(request()->is('product/create-product'))<span class="pull-right badge badge-success">Active</span>@endif<i class="fa fa-caret-right"></i>Add Product</a></li>
            <li><a href="{{route('product.list')}}">@if(request()->is('product/list'))<span class="pull-right badge badge-success">Active</span>@endif<i class="fa fa-caret-right"></i>Products List</a></li>     
          </ul>
        </li>
      
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  