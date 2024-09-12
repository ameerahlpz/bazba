<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Bazba Theatrical Players</title></head>
    <link rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body  {
	color:#000000;
	background-color:#FFFFFF;
	}

    a  { color:#0000FF; }
    a:visited { color:#800080; }
    a:hover { color:#008000; }
    a:active { color:#FF0000; }
    -->
    

body, div, p, h1, h2, h3, h4, h5, span { margin: 1; padding:2;}

div.spheader { width:100%; background: #000000; height:45px;}
.spheader ul.spmenu {

    border-right: 1px solid #333;

    margin: 0 0px;
    position: relative;
    width: auto;
}
ul.spmenu {
    list-style: none;
    position: relative;
    display: inline-table;
}

.spheader ul.spmenu li {
    display: inline;
    font-size: 13px;
    list-style: none outside none;
    margin: 0;
    padding: 0;
}

ul.spmenu li {
    height: 31px;
    text-transform: uppercase;
}

ul.spmenu li a{
    background-image: none;
    border-left: 1px solid #333;
    border-right: 1px solid #555;
    height: 31px;
    display: block;
}

ul.spmenu  li a {
    text-decoration:none;
    color: #FFFFFF;
    display: inline;
    float: right;
    font-weight: bold;
    line-height: 30px;
    position: relative;
    padding: 0 10px;
    font-family: Arial,Helvetica,"Arial Unicode MS",sans-serif;
}
ul.spmenu li select {
    border: 30;
    display: inline;
    float: right;
    font-weight: bold;
    line-height: 30px;
    position: relative;
    padding: 0 10px;
}
ul.spmenu li img
    align-items: right;
}

.spheader ul ul {
    display: none;
}

.spheader ul li:hover > ul {
        display: block;
    }

.spheader ul:after {
        content: ""; clear: both; display: block;
    }


.spheader ul ul {
    background: #DDD;  padding: 0px;
    position: absolute; top: 100%;
    align-items: right;
}
.spheader ul ul li {
        float: none; 
        border-top: 1px solid #6b727c;
        border-bottom: 1px solid #575f6a;
        position: relative;
    }
.spheader ul ul li a {
            padding: 0px 12px;
            color: #0000ff;
            position: relative;
            float: right;
            display: block;
        }  
       
.spheader ul ul li a:hover {
                background: #ccc;
            }


ul.spmenu  li ul li{
    clear:both;
    border-style:0px;
}
.main { 
        border: none;
}
.main h1 {
        font-size: 20px;
}
.btn {
     display: inline-block;
     background-color: #6fa8dc; 
     border: none;
     color: #ffffff;
     padding: 8px 30px;
     margin: 30px 0;
     border-radius: 30px;
     font-size: 15px;
     text-decoration: none;
     cursor: pointer;
}
    
table, th, td {
  border: 0px solid black;
  vertical-align: top;
}

.container {
        max-width: 1300px;
        margin: auto;
        padding-left: 0px;
        padding-right: 0px;
}

.row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: space-around;
      }
      
.footer {
        background: #000;
        color: #8a8a8a;
        font-size: 14px;
        /*padding: 25px 0 20px;*/
}

.footer p{
        color: #8a8a8a;
}
 
.footer h3 {
        color: #fff;
        margin-bottom: 20px;
}
.footer-col-1, .footer-col-2, .footer-col-3, .footer-col-4 {
        min-width: 250px;
        margin-bottom: 20px;
}
.footer-col-1 {
        flex-basis:30%;
        margin-left: 20px;
}
.footer-col-2 {
        flex: 1;
        text-align: center;
}
.footer-col-3, .footer-col-4 {
        flex-basis:12%;
        text-align: center;
}

ul {
        list-style-type:none;
   }
</style>

<div id="wrap">
    <table><tr><td width=25%><div id="header">
    <img id="logo" alt="Bazba Theatrical Players" src="./images/bazba_logo.jpg" style="width:75%"/>
    </div>
    <td width=75%><div id="header">
    <img id="logo" alt="Bazba Theatrical Players" src="./images/Bazba_Theatrical_Players.jpg" style="width:100%"/></tr></table>
    <div class="spheader" style="width:100%" >
    <ul class="spmenu">

    <li><select>
             <option name="currency">Select Currency</option>
             <option>USD</option>
             <option>CAD</option>
             <option>JAD</option>
        </select></li>
      
    <li><a href="index.html">Home</a></li>
      
    <li><a href="location.htm">Location</a></li>
      
    <li><a href="menu.htm">Menu</a></li>
    <li><img src="./images/bag.jpg" width="40px" height="40px"></li>
    </ul>
  </div></div>
				 

<form action="includes/connect.php" method="post"><br>
Qty: <input type="number" name="cost" value="0" min=0 max=100><br>
<input class="btn" type="submit" name="submit" value="Add to Cart">
</form>
  
  <!--------------Books for Sale-------------->
  
  <div class="main">
  <table cellpadding="15px" cellspacing="0">
            <tr><td width=25%><div id="header">
                    <img id="book"  alt="Bazba Theatrical Players" src="./images/The_Ants.png" style="width:75%"/>
                    <h1 id="detail-price">$CAD 6.99 $USD 5.99</h1> 
            </div>
                <td width=50%>
            <div id="header">
                    <p><h1 id="detail-title">The Ants</h1><br>
                    <small>Join Delores and her brother Ken as they climb the backyard mango tree.</small></p><br>
                            <a href="" class="btn">Add to Cart &#8594;</a>
                <td width=24%>
                    
<form action="includes/connect.php" method="post"><br>
Qty: <input type="number" name="cost" value="0" min=0 max=100><br>
<input class="btn" type="submit" name="submit" value="Add to Cart">
</form>
  
            
<!-----                                <button class="btn" type="button" name="insert_qty" onclick="myFunction()">Add to Cart</button>   ----->
<!-----                                <p id="cost"></p><br>										 ----->
				
            </p></tr>
                    
                    
            <tr><td width=30%><div id="header">
                    <img id="book"  alt="Bazba Theatrical Players" src="./images/Only_As_The_Wind_Blows.png" style="width:75%"/>
                    <h1 id="detail-price">$CAD 20.00 $USD 15.00</h1>
            </div>
                <td width=45%><div id="header">
                    <p><h1 id="detail-title">Only As The Wind Blows</h1><br>
                    <small>Only as the Wind Blows is a collection of short stories which deal mainly with the growing-up experiences of the author, Basil Lopez. Growing-up, however, necessitated leaving his island home, Jamaica. So some of the stories may be set in Miami, Toronto or New York. There is therefore a definite attempt to bridge the gap between what the author experienced at home and what he experienced in the wider world. In one regard the stories may seem to be particular since they deal with Caribbean people; but in another they may be regarded as universal since they attempt to fit our place in the world and since they deal with thoughts and emotions which are human. Flashes of humour permeate many of the stories.
                    </small></p><br>
                            <a href="" class="btn">Add to Cart &#8594;</a>
                <td width=24%>
                    <select>
                            <option>Select Currency</option>
                            <option>USD</option>
                            <option>CAD</option>
                            <option>JAD</option>
                    </select>
                    <input id=demoInput type=number min=0 max=40>
                                <button onclick="increment()">+</button>
                                <button onclick="decrement()">-</button>
            </p></tr>
                
            <tr><td width=30%><div id="header">
                    <img id="book"  alt="Bazba Theatrical Players" src="./images/Man_A_Yard.png" style="width:75%"/>
                    <h1 id="detail-price">$CAD 20.00 $USD 15.00</h1>
            </div>
                <td width=45%><div id="header">
                    <p><h1 id="detail-title">Man A Yard</h1><br>
                    <small></small></p><br>
                            <a href="" class="btn">Add to Cart &#8594;</a>
                    <td width=24%>
                    <select>
                            <option>Select Currency</option>
                            <option>USD</option>
                            <option>CAD</option>
                            <option>JAD</option>
                    </select>
                    <input id=demoInput type=number min=0 max=40>
                                <button onclick="increment()">+</button>
                                <button onclick="decrement()">-</button>
                    </tr>
                    
            <tr><td width=25%><div id="header">
                    <img id="book"  alt="Bazba Theatrical Players" src="./images/The_River.png" style="width:75%"/>
                    <h1 id="detail-price">$CAD 8.49 $USD 7.99</h1>
            </div>
                <td width=75%><div id="header">
                    <p><h1 id="detail-title">The River</h1><br>
                    <small></small></p><br>
                            <a href="" class="btn">Add to Cart &#8594;</a>
                    <td width=24%>
                    <select>
                            <option>Select Currency</option>
                            <option>USD</option>
                            <option>CAD</option>
                            <option>JAD</option>
                    </select>
                    <input id=demoInput type=number min=0 max=40>
                                <button onclick="increment()">+</button>
                                <button onclick="decrement()">-</button>
                    </tr>
                    
            <tr><td width=30%><div id="header">
                    <img id="book"  alt="Bazba Theatrical Players" src="./images/In_The_Palace.png" style="width:75%"/>
                    <h1 id="detail-price">$CAD 20.00 $USD 15.00</h1>
            </div>
                <td width=70%><div id="header">
                <p><h1 id="detail-title">In The Palace of the Gods</h1><br>
                <small></small></p><br>
                        <a href="" class="btn">Add to Cart &#8594;</a>
                    <td width=24%>
                    <select>
                            <option>Select Currency</option>
                            <option>USD</option>
                            <option>CAD</option>
                            <option>JAD</option>
                    </select>
                    <input id=demoInput type=number min=0 max=40>
                                <button onclick="increment()">+</button>
                                <button onclick="decrement()">-</button>
                    <button class="btn" type="button" onclick="myFunction()">Buy Now</button>
                        <tr><td colspan=3 align=right>Subtotal</td>
                        <td colspan=3 align=right>$40.00</td>
                        </tr>
                     <tr><td colspan=3 align=right>Tax</td>
                        <td colspan=3 align=right>$6.00</td>
                        </tr>
                     <tr><td colspan=3 align=right>Total Sale</td>
                        <td colspan=3 align=right>$46.00</td>
                        </tr>
                    </tr>
    </table>
  </div>
  
<div class="container">
   
  <div class="footer p-0">
  
  <div class="row">
          <div class="footer-col-1">
                  <h3>Download Our App</h3>
                  <p>Download App for Android and ios mobile phone.</p>
          </div>
           <div class="footer-col-2">
                  <h3>Choose Image</h3>
                  <p>For your reading pleasure, enjoy all our new stories!</p>
          </div>
          <div class="footer-col-3">
                  <h3>Useful Links</h3>
                  <ul>
                          <li>Coupons</li>
                          <li>Terms of Use</li>
                          <li>Return Policy</li>
                          <li>Privacy Policy</li>
                  </ul>
          </div>
           <div class="footer-col-4">
                  <h3>Follow Us</h3>
                  <ul>
                          <li>Facebook</li>
                          <li>Instagram</li>
                          <li>Twitter</li>
                          <li>YouTube</li>
                  </ul>
          </div>
      </div>
  </div>
</div>
<script>
        function myFunction() {
          var x = document.getElementById("demoInput");
          var defaultVal = x.defaultValue;
          var currentVal = x.value;

  
  if (defaultVal == currentVal) {
    
           document.getElementById("cost").innerHTML = "You have not add an item."
   
  } else {
    document.getElementById("cost").innerHTML = "The quantity value was: " + currentVal 
    + "<br>The new, current price is: " + currentVal * 6.99;
  }
}
</script>
</body>
</html>


