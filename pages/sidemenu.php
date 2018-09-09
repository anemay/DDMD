<!-- Side Menu เมนูด้านข้าง -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="index.php"><i class="fa fa-home fa-fw"></i> หน้าหลัก</a>
            </li>

            <!-- สำหรับ admin -->
            <?php if (isset($_SESSION["admin"])) { ?>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> การจัดการข้อมูลสมาชิก<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="register.php"><i class="fa fa-plus fa-fw"></i> เพิ่ม</a>
                    </li>
                    <li>
                        <a href="member-edit.php"><i class="fa fa-pencil fa-fw"></i>ข้อมูลสมาชิก</a>
                    </li>
                    </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="tables.html"><i class="fa fa-th-list   fa-fw"></i> การจัดการคะแนน<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="score.php"><span class="glyphicon glyphicon-align-left  " aria-hidden="true"></span> คะแนน</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sort-amount-desc  "></i> ประมวลผลคะแนน</a>
                    </li>
                    </ul>
            </li>
            <li>
                <a href="test-display.php"><i class="fa fa-pencil-square-o fa-fw"></i> การจัดการแบบทดสอบ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="test_add.php"><i class="fa fa-plus fa-fw"></i> เพิ่ม</a>
                    </li>
                    <li>
                        <a href="show_test.php"><i class="fa fa-book"></i> แสดงแบบทดสอบ</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="test-display.php"><i class="fa fa-pencil-square-o fa-fw"></i> ทำแบบทดสอบ</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-video-camera  fa-fw"></i> การจัดการแอนิเมชั่น<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-plus fa-fw"></i> เพิ่ม</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pencil fa-fw"></i> แก้ไข</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-minus fa-fw"></i> ลบ</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-group   fa-fw"></i> การจัดการข้อมูลผู้ใช้<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-plus fa-fw"></i> เพิ่ม</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pencil fa-fw"></i> แก้ไข</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-minus fa-fw"></i> ลบ</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="report.php"><i class="fa fa-print  fa-fw"></i> รายงานข้อมูล </span></a>
            </li>

            <li>
                <a href="service-logout.php"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
            </li>
          <?php } ?>

            <!-- สำหรับ user ธรรมดา -->
            <?php if (!isset($_SESSION["admin"]) && isset($_SESSION["email"])) { ?>
            <li>
                <a href="test-display.php"><i class="fa fa-pencil-square-o fa-fw"></i> ทำแบบทดสอบ</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-group   fa-fw"></i> การจัดการข้อมูลผู้ใช้<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-pencil fa-fw"></i> แก้ไข</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-minus fa-fw"></i> เปลี่ยนรหัสผ่าน</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="service-logout.php"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
            </li>
          <?php } ?>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
