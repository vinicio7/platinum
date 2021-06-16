<?php
use App\Models\Departament;
use App\Models\Municipality;
use App\Models\Zone;
use App\Models\Region;
use App\Models\Property;
use App\Models\Images;

  $busqueda    = Images::where('propierty_id',$data->propiertiy_id)->first();
  if($busqueda){
     $imagen =  $busqueda->path;
  }else{
     $imagen = ''; 
  }
$departamentos = Departament::all();  
$municipios    = Municipality::all();  
$zonas         = Zone::all();  
$regiones      = Departament::all();  
$propiedades   = Property::orderBy('propiertiy_id','ASC')->get()->take(16);
?>

<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <title>Propiedades &#8211; Platinum</title>
    <link rel="stylesheet" href="/css/fuente1.css" type="text/css" media="all">
    <link rel='stylesheet' href='/js/vendor/booked/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/essgrid/tooltipster.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/essgrid/tooltipster-light.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/booked/styles.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/revslider/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/_animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/colors.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/swiper/swiper.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/_messages.css' type='text/css' media='all' />
    <link rel="stylesheet" href="/css/social_bar.css" type="text/css" media="all">
    <style type="text/css">
      .input-icono {
        background-image: url('/images/search.png');
        background-repeat: no-repeat;
        background-position: 4px center;
        background-size: 20px;
        display: flex;
        align-items: center;
        padding-left: 28px;
        border: 1px solid white;
        border-radius: 3px;
      }
      .input-icono input {
        width: 100%;
        font-size: 0.9em;
      }
      .input-icono input:focus {
        outline: none;
      }
    </style>
</head>
 <body class="page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right">
      <div class="body_wrap">
         <div class="page_wrap">
            <header class="top_panel_wrap top_panel_style_1 scheme_original" style="position: fixed;z-index: 100000;width: 100%;">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
                     <div class="content_wrap clearfix" style="margin-left:50px;width: auto">
                        <div class="top_panel_logo">
                           <div class="logo">
                              <a href="./"><img src="/image/logo_lg_blanco.svg" class="logo_main"></a>
                           </div>
                        </div>
                        <div class="top_panel_menu">
                           <a href="/"><img src="/images/plecka.png"  style="width:100px;margin-left: 0px;margin-right: 20px;margin-top: 15px"></a>
                        </div>
                        <div class="top_panel_menu" style="margin-top: 50px;">
                           <nav class="menu_main_nav_area">
                              <ul id="menu_main" class="menu_main_nav">
                                <li class="menu-item"><a href="/">Inicio</a></li>
                                <li class="menu-item"><a href="/quienes">Quienes somos</a></li>
                                <li class="menu-item"><a href="/propiedades">Propiedades</a></li>
                                <li class="menu-item"><a href="/contacto">Contactenos</a></li>
                                <li class="menu-item"><a href="/login">Ingresar</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </header>
              <div class="page_content_wrap">
               <div class="content_wrap" style="margin-top: 50px">
                  <div class="content">
                     <section class="post_featured">
                        <div class="post_thumb">
                           <a class="hover_icon hover_icon_view" href="{{$imagen}}" title="87 Mishaum Point Rd, Dartmouth, MA 02748">
                           <span class="ps_single_status">sale</span>
                           <img alt="" src="{{$imagen}}"></a>
                        </div>
                     </section>
                     <section class="post_content">
                        <div class="post_info">
                           <span class="post_info_item">in <a class="property_group_link" href="#">For Sale</a>, 
                           <a class="property_group_link" href="#">Lux Property</a></span>
                           <span class="post_info_item">Started <a href="single-post.html" class="post_info_date date updated">February 5, 2016</a></span>
                           <span class="post_info_item post_info_counters">
                           <a class="post_counters_item" href="#"><span>0</span> Comments</a>
                           </span>
                        </div>
                        <h3 class="post_title">87 Mishaum Point Rd, Dartmouth, MA 02748</h3>
                        <div class="ps_single_info">
                           <div class="ps_single_info_descr">
                              Property ID: 20055, House. 
                           </div>
                           <div class="property_price_box"><span class="property_price_box_sign">$</span><span class="property_price_box_price">1,249,000</span></div>
                           <div class="sc_property_info_list">
                              <span class="icon-area_2">1,286 sqft</span><span class="icon-floor_plan">8</span><span class="icon-bed">2</span>
                              <span class="icon-bath">3</span><span class="icon-warehouse">2</span><span class="icon-crane">2001</span> 
                           </div>
                           <div class="cL"></div>
                        </div>
                        <div class="sc_section">
                           <p>The Moana Residence is situated on the best lot at Kohanaiki and is a 5 bedroom, 5 1/2 bath home of approximately 8,000 interior sq. ft. It features Ipe hardwood flooring on the interior and granite stone flooring on the lanais, granite countertops, vaulted cedar ceilings, clerestory windows for lots of light.</p>
                           <p>mahogany cabinetry, mahogany trim and pocketing doors throughout. The beautifully landscaped grounds include a large lap pool, spa and separate Pool.</p>
                           <div class="sc_line sc_line_position_center_center sc_line_style_solid margin_top_medium margin_bottom_medium"></div>
                           <h4 class="sc_title">Features &amp; Amenities</h4>
                           <div class="columns_wrap sc_columns">
                              <div class="column-1_2 sc_column_item">
                                 <ul class="sc_list sc_list_style_iconed color_1">
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Quiet Neighbourhood</p>
                                    </li>
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Great Local Community</p>
                                    </li>
                                 </ul>
                              </div>
                              <div class="column-1_2 sc_column_item">
                                 <ul class="sc_list sc_list_style_iconed color_1">
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Fabulous Views</p>
                                    </li>
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Large Play Center In Yard</p>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                         
                        </div>
                     </section>
                  </div>
                  <div class="sidebar widget_area scheme_original">
                     <div class="sidebar_inner widget_area_inner">
                        <aside class="widget widget_search">
                           <form method="get" class="search_form" action="#">
                              <input type="text" class="search_field" placeholder="Search &hellip;" value="" name="s" title="Search for:" /><button type="submit" class="search_button icon-search"></button>
                           </form>
                        </aside>
                        <aside class="widget widget_categories">
                           <h5 class="widget_title">categories</h5>
                           <ul>
                              <li class="cat-item"><a href="classic-with-sidebar.html">Classic With Sidebar</a> (15)
                              </li>
                              <li class="cat-item"><a href="classic-without-sidebar.html">Classic Without Sidebar</a> (15)
                              </li>
                              <li class="cat-item"><a href="#">Gallery</a> (12)
                              </li>
                              <li class="cat-item"><a href="masonry-2-columns.html">Masonry 2 columns</a> (15)
                              </li>
                              <li class="cat-item"><a href="masonry-3-columns.html">Masonry 3 columns</a> (15)
                              </li>
                              <li class="cat-item"><a href="#">New properties</a> (3)
                              </li>
                              <li class="cat-item"><a href="portfolio-2-columns.html">Portfolio 2 columns</a> (15)
                              </li>
                              <li class="cat-item"><a href="portfolio-3-columns.html">Portfolio 3 columns</a> (15)
                              </li>
                              <li class="cat-item"><a href="post-formats.html">Post Formats</a> (10)
                              </li>
                           </ul>
                        </aside>
                        <aside class="widget widget_recent_posts">
                           <h5 class="widget_title">Recent posts</h5>
                           <article class="post_item">
                              <div class="post_thumb"><img alt="" src="images/50x50.jpg"></div>
                              <div class="post_content">
                                 <div class="post_title"><a href="single-post.html">Making the Most of Your Small Space with Furniture</a></div>
                                 <div class="post_info"><span class="post_info_item">by <a href="#" class="post_info_author">Jesse Doe</a></span> <span class="post_info_item">on <a href="single-post.html">March 9, 2016</a></span>
                                 </div>
                              </div>
                           </article>
                           <article class="post_item">
                              <div class="post_thumb"><img alt="" src="images/50x50.jpg"></div>
                              <div class="post_content">
                                 <div class="post_title"><a href="single-post.html">4 Ways to Decorate Your First Apartment on a Budget</a></div>
                                 <div class="post_info"><span class="post_info_item">by <a href="#" class="post_info_author">Jesse Doe</a></span> <span class="post_info_item">on <a href="single-post.html">March 9, 2016</a></span>
                                 </div>
                              </div>
                           </article>
                           <article class="post_item">
                              <div class="post_thumb"><img alt="" src="images/50x50.jpg"></div>
                              <div class="post_content">
                                 <div class="post_title"><a href="single-post.html">How to Infuse Your Space with Natural Light</a></div>
                                 <div class="post_info"><span class="post_info_item">by <a href="#" class="post_info_author">Jesse Doe</a></span> <span class="post_info_item">on <a href="single-post.html">March 9, 2016</a></span>
                                 </div>
                              </div>
                           </article>
                        </aside>
                        <aside class="widget widget_archive">
                           <h5 class="widget_title">Archives</h5>
                           <ul>
                              <li><a href='#'>March 2016</a>&nbsp;(3)</li>
                              <li><a href='#'>February 2016</a>&nbsp;(104)</li>
                              <li><a href='#'>December 2015</a>&nbsp;(3)</li>
                              <li><a href='#'>November 2015</a>&nbsp;(2)</li>
                              <li><a href='#'>September 2015</a>&nbsp;(1)</li>
                              <li><a href='#'>August 2015</a>&nbsp;(1)</li>
                              <li><a href='#'>July 2015</a>&nbsp;(1)</li>
                           </ul>
                        </aside>
                        <aside class="widget widget_calendar">
                           <div class="calendar_wrap">
                              <table>
                                 <thead>
                                    <tr>
                                       <th class="month_prev">
                                          <a href="#"></a>
                                       </th>
                                       <th class="month_cur" colspan="5">August <span>2016</span></th>
                                       <th class="month_next">&nbsp;</th>
                                    </tr>
                                    <tr>
                                       <th class="weekday" scope="col" title="Monday">M</th>
                                       <th class="weekday" scope="col" title="Tuesday">T</th>
                                       <th class="weekday" scope="col" title="Wednesday">W</th>
                                       <th class="weekday" scope="col" title="Thursday">T</th>
                                       <th class="weekday" scope="col" title="Friday">F</th>
                                       <th class="weekday" scope="col" title="Saturday">S</th>
                                       <th class="weekday" scope="col" title="Sunday">S</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td class="day"><span class="day_wrap">1</span></td>
                                       <td class="day"><span class="day_wrap">2</span></td>
                                       <td class="day"><span class="day_wrap">3</span></td>
                                       <td class="day"><span class="day_wrap">4</span></td>
                                       <td class="day"><span class="day_wrap">5</span></td>
                                       <td class="day"><span class="day_wrap">6</span></td>
                                       <td class="day"><span class="day_wrap">7</span></td>
                                    </tr>
                                    <tr>
                                       <td class="day"><span class="day_wrap">8</span></td>
                                       <td class="day"><span class="day_wrap">9</span></td>
                                       <td class="day"><span class="day_wrap">10</span></td>
                                       <td class="day"><span class="day_wrap">11</span></td>
                                       <td class="day"><span class="day_wrap">12</span></td>
                                       <td class="day"><span class="day_wrap">13</span></td>
                                       <td class="day"><span class="day_wrap">14</span></td>
                                    </tr>
                                    <tr>
                                       <td class="day"><span class="day_wrap">15</span></td>
                                       <td class="day"><span class="day_wrap">16</span></td>
                                       <td class="day"><span class="day_wrap">17</span></td>
                                       <td class="day"><span class="day_wrap">18</span></td>
                                       <td class="day"><span class="day_wrap">19</span></td>
                                       <td class="day"><span class="day_wrap">20</span></td>
                                       <td class="day"><span class="day_wrap">21</span></td>
                                    </tr>
                                    <tr>
                                       <td class="day"><span class="day_wrap">22</span></td>
                                       <td class="day"><span class="day_wrap">23</span></td>
                                       <td class="day"><span class="day_wrap">24</span></td>
                                       <td class="day"><span class="day_wrap">25</span></td>
                                       <td class="day"><span class="day_wrap">26</span></td>
                                       <td class="day"><span class="day_wrap">27</span></td>
                                       <td class="day"><span class="day_wrap">28</span></td>
                                    </tr>
                                    <tr>
                                       <td class="day"><span class="day_wrap">29</span></td>
                                       <td class="day"><span class="day_wrap">30</span></td>
                                       <td class="today"><span class="day_wrap">31</span></td>
                                       <td class="pad" colspan="4"><span class="day_wrap">&nbsp;</span></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </aside>
                        <aside class="widget widget_tag_cloud">
                           <h5 class="widget_title">Tags</h5>
                           <div class="tagcloud"><a href='#'>Attic</a>
                              <a href='#'>Basement</a>
                              <a href='#'>Bedroom</a>
                              <a href='#'>Commute</a>
                              <a href='#'>Driveway</a>
                              <a href='#'>Features</a>
                              <a href='#'>Garage</a>
                              <a href='#'>Kitchen</a>
                              <a href='#'>Living room</a>
                              <a href='#'>Popular</a>
                              <a href='#'>Premium</a>
                              <a href='#'>Studio</a>
                           </div>
                        </aside>
                        <aside class="widget null-instagram-feed">
                           <h5 class="widget_title">Instagram</h5>
                           <ul class="instagram-pics instagram-size-small">
                              <li class="">
                                 <a href="http://instagram.com/p/BB-XKPZlTX4" target="_blank" class=""><img src="images/320x320.jpg" alt="Instagram Image" title="Instagram Image" class="" /></a>
                              </li>
                              <li class="">
                                 <a href="http://instagram.com/p/BB-XI-LlTX2" target="_blank" class=""><img src="images/320x320.jpg" alt="Instagram Image" title="Instagram Image" class="" /></a>
                              </li>
                              <li class="">
                                 <a href="http://instagram.com/p/BB-XHHmlTXx" target="_blank" class=""><img src="images/320x320.jpg" alt="Instagram Image" title="Instagram Image" class="" /></a>
                              </li>
                              <li class="">
                                 <a href="http://instagram.com/p/BB-XFf1lTXu" target="_blank" class=""><img src="images/320x320.jpg" alt="Instagram Image" title="Instagram Image" class="" /></a>
                              </li>
                              <li class="">
                                 <a href="http://instagram.com/p/BB-XAdNFTXf" target="_blank" class=""><img src="images/320x320.jpg" alt="Instagram Image" title="Instagram Image" class="" /></a>
                              </li>
                              <li class="">
                                 <a href="http://instagram.com/p/BB-W9ctFTXY" target="_blank" class=""><img src="images/320x320.jpg" alt="Instagram Image" title="Instagram Image" class="" /></a>
                              </li>
                           </ul>
                        </aside>
                     </div>
                  </div>
               </div>
            </div>

        <div class="copyright_wrap copyright_style_menu scheme_original">
            <div class="copyright_wrap_inner">
                <div class="content_wrap">

                    <div class="copyright_text"><center>Platinum © 2021 All Rights Reserved</center></div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="float-sm">
        <div class="fl-fl float-fb">          
          <a href="https://www.facebook.com/propiedadesplatinumguatemala" target="_blank" style="color:white!important">Búscanos en Facebook</a>
          <i class="fa fa-facebook" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-gp">
          <a href="https://www.instagram.com/propiedades_platinum/" target="_blank" style="color:white!important">Síguenos en Instagram</a>
          <i class="fa fa-instagram" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-ig">
          <a href="https://www.linkedin.com/in/sarah-alzugaray-1315b81a6/" target="_blank" style="color:white!important">Conéctate en LinkedIn</a>
          <i class="fa fa-linkedin" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-pn">
          <a href="https://www.youtube.com/channel/UCK7CdSf2FUQKGcEJ7L9yDcA/featured" target="_blank" style="color:white!important">Suscríbete en Youtube</a>
          <i class="fa fa-youtube" style="text-align: right!important;"></i>
        </div>
      </div>

      <a href="#" class="scroll_to_top icon-up"></a>
      <script type='text/javascript' src='/js/vendor/jquery.js'></script>
      <script type='text/javascript' src='/js/custom/plugins.js'></script>
      <script type='text/javascript' src='/js/custom/messages.js'></script>
      <script type='text/javascript' src='/js/vendor/jquery-migrate.min.js'></script>
      <script type='text/javascript' src='/js/vendor/modernizr.min.js'></script>
      <script type='text/javascript' src='/js/vendor/ui/jquery-ui.min.js'></script>
      <script type='text/javascript' src='/js/vendor/superfish.js'></script>
      <script type='text/javascript' src='/js/custom/_utils.js'></script>
      <script type='text/javascript' src='/js/custom/_init.js'></script>
      <script type='text/javascript' src='/js/custom/_shortcodes.js'></script>
      <script type='text/javascript' src='/js/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>
   </body>
</html>
