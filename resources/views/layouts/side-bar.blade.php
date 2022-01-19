<!-- Tabs content start -->
<style>
.bill{
    font-family: Allerta;
    color:#7373e2;
    margin-right: 17px;
    margin-top: 9px;
}
@media screen and (max-width: 600px) {
  .search-container a:not(:first-child) {display: none;}
  .search-container a.icon {
    float: right;
    display: block;
  }
}
    </style>
	
	
 
                        
                    </nav>       
                    <!-- Sidebar wrapper end -->
        
                    <!-- *************
                        ************ Main container start *************
                    ************* -->
                    <div class="main-container">
        
                        <!-- Page header starts -->
                        <div class="page-header">
                            
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">
        
                                    <!-- Search container start -->
                                    <div class="search-container">
        
                                        <!-- Toggle sidebar start -->
                                       
                                        <!-- Toggle sidebar end -->
        
                                        <!-- Mega Menu Start -->
                                        <div class="cd-dropdown-wrapper">
                                            
                                            <nav class="cd-dropdown">
                                            
                                              
                                            </nav>
                                        </div>
                                        <!-- Mega Menu End -->
        
                                        <!-- Search input group start -->

                                        <a href="{{url('/dashboard')}}" class="logo">
							<img src="img/billing.png" alt="Uni Pro Admin">
						</a>

                              <a class='bill'  href="{{url('/dashboard')}}"><h2>GAS BILL</h2></a>      

                        <div class="custom-btn-group">
                                        <a href="{{url('/company-setup')}}" class="btn btn-outline-primary" role="button" aria-pressed="true">Company Setup</a>
                                      </div>
                                       
                                        <div class="custom-btn-group">
                                        <a href="{{url('/getpdf')}}" class="btn btn-outline-primary" role="button" aria-pressed="true">Combined Pdf</a>
                                      </div>
                                      <div class="custom-btn-group">
                                        <a href="{{url('/monthly')}}" class="btn btn-outline-primary" role="button" aria-pressed="true">View Monthly Data</a>
                                      </div>
                                      <div class="custom-btn-group">
                                        <a href="{{url('/invoicepdf')}}" class="btn btn-outline-primary" role="button" aria-pressed="true">Single Invoice Pdf</a>
                                      </div>
                                        
                                        
                                        <div>
                                        <div id="date-div"></div>
                                        </div>
                                      
                                       <!-- Card start -->
				
								<!-- Card end -->
     
                                        <!-- Search input group end -->
        
                                    </div>
                                    <!-- Search container end -->
        
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">
        
                                    <!-- Header actions start -->
                                    <ul class="header-actions">
                                        <li class="dropdown">
                                        <div id="time" class="time"></div>
                                          
                                        

                                        </li>
                                        <li class="dropdown">
                                            <div>
                                                
                               <!--         <input type="date" id="theDate" class="theDate">   -->
                                         </div>

                                        </li>
                                        <li class="dropdown">
                                        <div>
                                                
                                                <a href="{{route('login')}}" class="logo">
                                    <img src="img/logout.png" alt="Uni Pro Admin" style="width: 42px;
                                                          margin-top: 14px;
                                                          height: 42px;">
                                         </a>
                                                  
                                                 </div>
                                        </li>
                                    </ul>
                                    <!-- Header actions end -->
                                </div>
                            </div>
                            <!-- Row end -->					
        
                        </div>
                        <!-- Page header ends -->
                       

              