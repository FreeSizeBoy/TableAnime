<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Anime World</title>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>ยินดีต้อนรับสู่โลกแห่งอนิเมะ!</h1>
        <!-- เมนูนำทางสำหรับผู้ใช้ -->
        <nav>
            <a href="#">เกี่ยวกับเรา</a>
            <a href="#">บริการ</a>
            <a href="#">ติดต่อเรา</a>
            <a href="#">เข้าสู่ระบบ</a>
        </nav>
    </header>

    <main>
        <h2>เริ่มต้นการเดินทางของคุณวันนี้!</h2>
        <!-- ส่วนของสไลด์ภาพอนิเมะ -->
        <div class="slider">
            <div class="slides">
                <img src="yuki.jpg" class="slide active" alt="Anime Image 1">
                <img src="https://i.pinimg.com/564x/ce/9b/25/ce9b25a974d9865de1fbd689850bacfe.jpg" class="slide" alt="Anime Image 2">
                <img src="https://i.pinimg.com/736x/eb/48/4b/eb484b03baa9d1787cc909294b06698b.jpg" class="slide" alt="Anime Image 3">
                <!-- เพิ่มรูปภาพเพิ่มเติมที่นี่ -->
            </div>
        </div>
        <!-- ปุ่มเพื่อเริ่มต้นใช้งาน -->
        <button><a href="dashboard.php">เริ่มต้น</a></button>
    </main>

    <div class="logo">
        <h3>แอปที่เอาไว้ดู</h3>
        <a href="https://www.bilibili.tv/th"><img src="https://i.pinimg.com/564x/1e/87/9d/1e879dfaa9ff8490af7567c507dba503.jpg" alt=""></a>
        
    </div>

    <footer>
        <p>ติดตามเราบนโซเชียลมีเดีย!</p>
        <p>&copy; 2024 โลกแห่งอนิเมะ. สงวนลิขสิทธิ์.</p>
    </footer>

    <script>
        // ตัวแปรเพื่อเก็บ index ของสไลด์ที่แสดงอยู่
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');

        // ฟังก์ชันในการแสดงสไลด์
        function showSlides() {
            // ซ่อนทุกสไลด์
            slides.forEach((slide, index) => {
                slide.classList.remove('active', 'outgoing'); // ลบคลาส active และ outgoing
            });

            // แสดงสไลด์ที่ active
            slides[slideIndex].classList.add('active'); // เพิ่มคลาส active ให้กับสไลด์ที่แสดง

            // เพิ่มคลาส outgoing สำหรับสไลด์ที่ออก
            const outgoingIndex = (slideIndex - 1 + slides.length) % slides.length; // คำนวณ index ของสไลด์ที่ออก
            slides[outgoingIndex].classList.add('outgoing'); // เพิ่มคลาส outgoing ให้กับสไลด์ที่ออก

            // อัพเดต index สำหรับรอบถัดไป
            slideIndex = (slideIndex + 1) % slides.length; // เปลี่ยนสไลด์ถัดไป
        }

        // เรียกฟังก์ชันทุก 3 วินาที
        setInterval(showSlides, 3000);
    </script>
</body>
</html>
