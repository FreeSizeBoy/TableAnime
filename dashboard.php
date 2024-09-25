<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashborad.css"> <!-- ตรวจสอบชื่อไฟล์ CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Anime Dashboard</title>
    <style>
        .on-time {
            background-color: green; /* สีเขียวสำหรับเวลาที่กำหนด */
            color: white; /* สีข้อความ */
        }
        .late {
            background-color: red; /* สีแดงสำหรับเวลาที่ยังไม่ถึง */
            color: white; /* สีข้อความ */
        }
        /* Responsive styling */
        @media (max-width: 768px) {
            table {
                width: 100%;
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="parallax"></div>
    <div class="container">
        <h1>Anime เดือนตุลาคม</h1>
        <form id="anime-form">
            <div class="form-group">
                <label for="anime-title">ชื่อ Anime:</label>
                <input type="text" id="anime-title" required aria-label="ชื่อ Anime">
            </div>
            <div class="form-group">
                <label for="anime-day">เลือกวัน:</label>
                <select id="anime-day" required aria-label="เลือกวัน">
                    <option value="จันทร์">จันทร์</option>
                    <option value="อังคาร">อังคาร</option>
                    <option value="พุธ">พุธ</option>
                    <option value="พฤหัสบดี">พฤหัสบดี</option>
                    <option value="ศุกร์">ศุกร์</option>
                    <option value="เสาร์">เสาร์</option>
                    <option value="อาทิตย์">อาทิตย์</option>
                </select>
            </div>
            <div class="form-group">
                <label for="anime-date">เลือกวันที่:</label>
                <input type="date" id="anime-date" required aria-label="เลือกวันที่">
            </div>
            <div class="form-group">
                <label for="anime-time">เลือกเวลา:</label>
                <input type="time" id="anime-time" required aria-label="เลือกเวลา">
            </div>
            <div class="form-group">
                <label for="anime-year">ตอน:</label>
                <input type="text" id="anime-year" required aria-label="ตอน">
            </div>
            <div class="form-group">
                <label for="anime-channel">ช่องทาง:</label>
                <select id="anime-channel" required aria-label="เลือกช่องทาง">
                    <option value="">เลือกช่องทาง</option>
                    <option value="Bilibili">Bilibili</option>
                    <option value="Primevideo">Primevideo</option>
                    <option value="ช่อง 3">ช่อง 3</option>
                    <option value="ช่อง 4">ช่อง 4</option>
                    <option value="ช่อง 5">ช่อง 5</option>
                    <option value="ยังไม่มี">ยังไม่มี</option>
                </select>
            </div>
            <div class="form-group">
                <label for="anime-image">เลือกไฟล์รูปภาพ:</label>
                <input type="file" id="anime-image" accept="image/*" aria-label="เลือกไฟล์รูปภาพ">
                <img id="image-preview" src="" alt="Preview" style="display:none; width: 100px; height: 100px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="anime-image-link">ลิงค์รูปภาพ:</label>
                <input type="url" id="anime-image-link" placeholder="ใส่ลิงค์รูปภาพ" aria-label="ลิงค์รูปภาพ">
            </div>
            <button type="submit" id="submit-button" aria-label="เพิ่มรูปภาพ">เพิ่มรูปภาพ</button>
        </form>

        <table id="anime-table">
            <thead>
                <tr>
                    <th>วัน</th>
                    <th>รูปภาพ</th>
                    <th>ชื่อ Anime</th>
                    <th>วันที่</th>
                    <th>เวลา</th>
                    <th>ตอน</th>
                    <th>ช่องทาง</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <!-- ข้อมูล Anime จะถูกเพิ่มที่นี่ -->
            </tbody>
        </table>
    </div>

    <script>
        const animeData = JSON.parse(localStorage.getItem('animeData')) || [];
        let editIndex = -1;

        function displayAnimeData() {
            sortAnimeData(); // เรียงลำดับก่อนแสดงข้อมูล
            const animeTableBody = document.querySelector('#anime-table tbody');
            animeTableBody.innerHTML = ''; // เคลียร์ข้อมูลก่อนหน้า
            animeData.forEach((anime, index) => {
                const animeRow = document.createElement('tr');

                const dayCell = document.createElement('td');
                dayCell.textContent = anime.day;

                // เปลี่ยนสีตามวัน
                switch (anime.day) {
                    case 'จันทร์':
                        dayCell.style.backgroundColor = '#ffeb3b'; // สีเหลือง
                        break;
                    case 'อังคาร':
                        dayCell.style.backgroundColor = '#2196f3'; // สีน้ำเงิน
                        break;
                    case 'พุธ':
                        dayCell.style.backgroundColor = '#4caf50'; // สีเขียว
                        break;
                    case 'พฤหัสบดี':
                        dayCell.style.backgroundColor = '#ff9800'; // สีส้ม
                        break;
                    case 'ศุกร์':
                        dayCell.style.backgroundColor = '#00FFFF'; // สีฟ้า
                        break;
                    case 'เสาร์':
                        dayCell.style.backgroundColor = '#9c27b0'; // สีม่วง
                        break;
                    case 'อาทิตย์':
                        dayCell.style.backgroundColor = '#FF3300'; // สีแดง
                        break;
                    default:
                        dayCell.style.backgroundColor = ''; // ไม่มีสี
                        break;
                }

                animeRow.appendChild(dayCell);

                const imgCell = document.createElement('td');
                const img = document.createElement('img');
                img.src = anime.imgSrc; // รูปภาพ
                img.alt = anime.title;
                img.style.width = '100px';
                img.style.height = '100px';
                imgCell.appendChild(img);
                animeRow.appendChild(imgCell);

                const titleCell = document.createElement('td');
                titleCell.textContent = anime.title;
                animeRow.appendChild(titleCell);

                const dateCell = document.createElement('td');
                dateCell.textContent = formatDate(anime.date);
                animeRow.appendChild(dateCell);

                const timeCell = document.createElement('td');
                timeCell.textContent = anime.time;
                animeRow.appendChild(timeCell);

                const yearCell = document.createElement('td');
                yearCell.textContent = anime.year;
                animeRow.appendChild(yearCell);

                const channelCell = document.createElement('td'); // ช่องทาง
                channelCell.textContent = anime.channel; // เพิ่มข้อมูลช่องทาง
                animeRow.appendChild(channelCell);

                const editCell = document.createElement('td');
                const editButton = document.createElement('button');
                editButton.textContent = 'แก้ไข';
                editButton.addEventListener('click', function() {
                    editAnime(index);
                });
                editCell.appendChild(editButton);
                animeRow.appendChild(editCell);

                const deleteCell = document.createElement('td');
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'ลบ';
                deleteButton.addEventListener('click', function() {
                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: "คุณต้องการลบข้อมูลนี้หรือไม่?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ลบ',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteAnime(index);
                            Swal.fire('ลบแล้ว!', 'ข้อมูลของคุณถูกลบเรียบร้อยแล้ว.', 'success');
                        }
                    });
                });
                deleteCell.appendChild(deleteButton);
                animeRow.appendChild(deleteCell);

                animeTableBody.appendChild(animeRow);
            });
        }

        function addAnime(event) {
            event.preventDefault(); // ป้องกันการโหลดหน้าใหม่

            const title = document.getElementById('anime-title').value;
            const day = document.getElementById('anime-day').value;
            const date = document.getElementById('anime-date').value;
            const time = document.getElementById('anime-time').value;
            const year = document.getElementById('anime-year').value;
            const channel = document.getElementById('anime-channel').value;
            const image = document.getElementById('anime-image').files[0];
            const imgSrc = image ? URL.createObjectURL(image) : document.getElementById('anime-image-link').value;

            if (editIndex >= 0) {
                // แก้ไขข้อมูลที่มีอยู่
                animeData[editIndex] = { title, day, date, time, year, channel, imgSrc };
                editIndex = -1; // ตั้งค่า editIndex ใหม่
                document.getElementById('submit-button').textContent = 'เพิ่มรูปภาพ'; // เปลี่ยนข้อความปุ่ม
            } else {
                // เพิ่มข้อมูลใหม่
                animeData.push({ title, day, date, time, year, channel, imgSrc });
            }

            localStorage.setItem('animeData', JSON.stringify(animeData));
            displayAnimeData();

            // ล้างฟอร์ม
            document.getElementById('anime-form').reset();
            document.getElementById('image-preview').style.display = 'none';
        }

        function editAnime(index) {
            editIndex = index; // ตั้งค่า editIndex
            const anime = animeData[index];

            document.getElementById('anime-title').value = anime.title;
            document.getElementById('anime-day').value = anime.day;
            document.getElementById('anime-date').value = anime.date;
            document.getElementById('anime-time').value = anime.time;
            document.getElementById('anime-year').value = anime.year;
            document.getElementById('anime-channel').value = anime.channel;
            document.getElementById('anime-image-link').value = anime.imgSrc; // แสดงลิงค์ภาพในฟอร์ม

            // แสดงภาพตัวอย่าง
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = anime.imgSrc;
            imgPreview.style.display = 'block';

            document.getElementById('submit-button').textContent = 'แก้ไขรูปภาพ'; // เปลี่ยนข้อความปุ่ม
        }

        function deleteAnime(index) {
            animeData.splice(index, 1); // ลบข้อมูลที่ระบุ
            localStorage.setItem('animeData', JSON.stringify(animeData));
            displayAnimeData();
        }

        function formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(date).toLocaleDateString('th-TH', options);
        }

        function sortAnimeData() {
            animeData.sort((a, b) => new Date(a.date) - new Date(b.date));
        }

        document.getElementById('anime-form').addEventListener('submit', addAnime);
        document.getElementById('anime-image').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = document.getElementById('image-preview');
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block'; // แสดงภาพตัวอย่าง
                };
                reader.readAsDataURL(file);
            }
        });

        displayAnimeData(); // เรียกใช้เพื่อแสดงข้อมูลเริ่มต้น
    </script>
</body>
</html>
