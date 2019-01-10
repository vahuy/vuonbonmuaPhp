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
                        <div class='col-md-3'><a href='/dashboard/homepage.php'>Trang chủ</a></div>
                        <div class='col-md-3'><a href='/dashboard/climbing.php'>Climbing - Hồng leo</a></div>
                        <div class='col-md-3'><a href='/dashboard/shrub.php'>Shrub - Hồng bụi</a></div>
                        <div class='col-md-3'><a href='/dashboard/treatment.php'>Thuốc hữu cơ</a></div>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}