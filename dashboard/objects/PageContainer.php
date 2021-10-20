<?php
class PageContainer {
    function renderFooter() {
            return "
            <div class='row'>
                <div class='col-md-4'>
                    <h3>Hướng dẫn trồng hồng</h3>
                    <ul>
                        <li><a href='/dashboard/notes/note.php?danhsach'>Danh sách cây đang bán - Update liên tục</a></li>
                        <li><a href='/dashboard/notes/note.php?phanbiet'>Phân biệt cây giâm cành, cây chiết và cây ghép</a></li>
                        <li><a href='/dashboard/notes/note.php?hinhdang'>Các kiểu hình dáng của hoa hồng</a></li>
                        <li><a href='/dashboard/notes/note.php?shoppinglist'>Danh sách shopping cho người mới trồng hoa hồng</a></li>
                        <li><a href='/dashboard/notes/note.php?trondat'>Cách trộn giá thể trồng hồng trong chậu</a></li>
                        <li><a href='/dashboard/notes/note.php?phanhuuco'>Vì sao ta nên dùng phân hữu cơ thay cho phân hóa học?</a></li>
                    </ul>
                </div>
                <div class='col-md-4'>
                    <h3>Liên hệ</h3>
                    <ul>
                        <li><i class='fa fa-phone'></i><span>0907973260</span></li>
                        <li><i class='fa fa-phone'></i><span>0834081584</span></li>
                        <li><i class='fa fa-envelope'></i><span>meomoskincare_cskh@outlook.com</span></li>
                    </ul>
                </div>
                <div class='col-md-4'>
                    <h3>Vườn bốn mùa trên facebook</h3>
                    <a class='fa fa-facebook' href='https://www.facebook.com/vuonSGbonmua/'></a><span class='like-us-text'><a href='https://www.facebook.com/vuonSGbonmua/'>Like us on facebook</a></span>
                </div>
            </div>
        ";
        }

    function renderHeader() {
            return "
            <div class='top-bar'>
            <div class='top-bar-section'>
                <!-- Right Nav Section -->
                <div class='header-navigation'>
                    <div class='row'>
                        <div class='col-md-2'><a href='/dashboard/homepage.php'>Trang chủ</a></div>
                        <div class='col-md-3'><a href='/dashboard/climbing.php'>Climbing - Hồng leo</a></div>
                        <div class='col-md-2'><a href='/dashboard/shrub.php'>Shrub - Hồng bụi</a></div>
                        <div class='col-md-2'><a href='/dashboard/otherPlants.php'>Cây khác</a></div>
                        <div class='col-md-2'><a href='/dashboard/treatment.php'>Thuốc hữu cơ</a></div>
                    </div>
                </div>
            </div>
        </div>
        ";
    }

    function renderHeaderWithLogin($isLogged) {
        if ($isLogged===true) {
            $button = "
                <div class='col-md-2'>
                    <form method='post'>
                        <button type='submit' name='logout' id='logout' formaction='/dashboard/admin/processor/login.php'>Đăng xuất</button>
                    </form>
                </div>
                ";
        } else {
            $button = "<div class='col-md-2'><button type='submit' id='login'>Đăng nhập</button></div>";
        }
        return "
            <div class='top-bar'>
            <div class='top-bar-section'>
                <!-- Right Nav Section -->
                <div class='header-navigation'>
                    <div class='row'>
                        <div class='col-md-2'><a href='/dashboard/homepage.php'>Trang chủ</a></div>
                        <div class='col-md-2'><a href='/dashboard/climbing.php'>Climbing - Hồng leo</a></div>
                        <div class='col-md-2'><a href='/dashboard/shrub.php'>Shrub - Hồng bụi</a></div>
                        <div class='col-md-2'><a href='/dashboard/otherPlants.php'>Cây khác</a></div>
                        <div class='col-md-2'><a href='/dashboard/treatment.php'>Thuốc hữu cơ</a></div>
                        $button
                    </div>
                </div>
            </div>
        </div>
        ";
    }

    function renderAdminHeaderWithLogin($isLogged) {
        if ($isLogged===true) {
            $button = "
                <div class='col-md-2'>
                    <form method='post'>
                        <button type='submit' name='logout' id='logout' formaction='/dashboard/admin/processor/login.php'>Đăng xuất</button>
                    </form>
                </div>
                ";
        } else {
            $button = "<div class='col-md-2'><button type='submit' id='login'>Đăng nhập</button></div>";
        }
        return "
            <div class='top-bar'>
            <div class='top-bar-section'>
                <!-- Right Nav Section -->
                <div class='header-navigation'>
                    <div class='row'>
                        <div class='col-md-2'><a href='/dashboard/homepage.php'>Trang chủ</a></div>
                        <div class='col-md-2'><a href='/dashboard/admin/addproduct.php'>Add Product</a></div>
                        <div class='col-md-2'><a href='/dashboard/admin/addphoto.php'>Add Photo</a></div>
                        <div class='col-md-2'><a href='/dashboard/otherPlants.php'>Cây khác</a></div>
                        <div class='col-md-2'><a href='/dashboard/admin/addproductmoreinfo.php'>Add more info</a></div>
                        $button
                    </div>
                </div>
            </div>
        </div>
        ";
    }

    function renderModal($modalName, $modalContent, $modalButton) {
        return "
            <div class='modal-content'>
              <div class='modal-header'>
                <h4>$modalName</h4>
                <span class='close'>&times;</span>
              </div>
              <div class='modal-body'>
                $modalContent
              </div>
              <div class='modal-footer'>
                <h3>Footer</h3>
              </div>
            </div>
        ";
    }

    function renderModalLogin()
    {
        return "
            <div class='modal-content' id='myModal'>
              <div class='modal-header'>
                <h4>Đăng nhập</h4>
                <span class='close'>&times;</span>
              </div>
              <div class='modal-body'>
                <form action='/dashboard/admin/processor/login.php' method='post'>
                    Tên: <input type='text' name='name'><br>
                    Mật khẩu: <input type='password' name='password'><br>
                    <button type='submit' id='submit' name='submit'>Submit</button>
                </form>
              </div>
            </div>
        ";
    }

}