function openChiTietDonHang(MaDH, MaTK) {
      let modal = document.getElementById("modal-chiTietDonHang");
      $.ajax({
            url: "Controller/DonHangController.php",
            method: "POST",
            data: { 
                  action : "getChiTietDonHang",
                  MaDH : MaDH,
            },
            success : function(response){
                  console.log(response)
                  let data = JSON.parse(response);
                  if (data.status === "success") {
                    let donHang = data.donHang;
                    let chiTietDonHang = data.chiTietDonHang;
                    let khuyenMai = data.khuyenMai;
                    let diaChi = data.diaChi;
                    let trangThaiOptions = {};
                    switch (donHang.TrangThaiDH) {
                        case "Chưa Xác Nhận":
                            trangThaiOptions = {
                                "Chưa Xác Nhận": "orange",
                                "Đã Xác Nhận": "blue",
                                "Hoàn Thành": "#05cc06"
                            };
                            break;
                        case "Đã Xác Nhận":
                            trangThaiOptions = {
                                "Đã Xác Nhận": "blue",
                                "Hoàn Thành": "#05cc06",
                            };
                            break;
                        case "Hoàn Thành":
                            trangThaiOptions = {
                                "Hoàn Thành": "#05cc06"
                            };
                            break;
                        case "Hủy":
                            trangThaiOptions = {
                                "Hủy": "red"
                            };
                            break;
                    
                        default:
                            break;
                    }
                        

        let inner = "";
        inner = `
        <div id="adminOrderDetail-container" style="max-height: 80vh; overflow-y: auto;">
            <i class="fa-solid fa-x"  id="closeAdminOrderDetail" onclick="closeChiTietDonHang()"></i>
            <p style="margin:22px; font-size:25px;">| Chi Tiết Đơn Hàng</p>
             <!-- Trạng thái đơn hàng -->
            <p style="margin:22px; font-size:25px;">Trạng Thái Đơn Hàng: 
                <!-- Dropdown chọn trạng thái đơn hàng -->
                <select id="updateTrangThai" style="font-size:20px;">
                    ${Object.keys(trangThaiOptions).map(status => `
                        <option  style="color:${trangThaiOptions[status]}; background:white;" value="${donHang.TrangThaiDH === status ? "" : status}" ${donHang.TrangThaiDH === status ? "selected" : ""}>${status}</option>
                    `).join('')}
                </select>`;
            if(donHang.TrangThaiDH == "Chưa Xác Nhận" || donHang.TrangThaiDH == "Đã Xác Nhận") 
              inner +=  `<button id="capNhatTrangThai" onclick="capNhatTrangThai('${MaDH}', '${MaTK}')" style="margin-left: 10px; padding: 5px 10px; font-size: 16px;">Cập Nhật</button>`
            inner +=  `</p>
            <div id="adminOrderDetail-diachi">
            <p id="adminOrderDetail-diachi-title"><i class="fa-solid fa-location-dot"></i> Địa Chỉ Giao Hàng</p>
                <div class="adminOrderDetail-diachi-item">
                    <div class="adminOrderDetail-diachi-item-info">
                        <p class="adminOrderDetail-diachi-item-name">${diaChi.HoTen}</p>
                        <p class="adminOrderDetail-diachi-item-sodienthoai">${diaChi.SoDienThoai}</p>
                    </div>
                    <div class="adminOrderDetail-diachi-item-chitietdiachi">${diaChi.ChiTietDC}</div>
                </div>
            </div>
            <div id="adminOrderDetail-khuyenmai">
            <p style="font-size:22px; font-weight:bold;">Khuyến Mãi Đã Áp Dụng</p>
                ${khuyenMai ? `
                    <div class="adminOrderDetail-khuyenmai-item">
                        <div class="adminOrderDetail-khuyenmai-item-info">
                            <p class="adminOrderDetail-khuyenmai-item-name"><i class="fa-solid fa-circle-dot" style="font-size: 15px;"></i> ${khuyenMai.TenKM}</p>
                            <p class="adminOrderDetail-khuyenmai-item-mota">${khuyenMai.MoTaKM}</p>
                        </div>
                    </div>` : `<p><i class='fa-solid fa-circle-dot'></i> Không có.</p>`}
            </div>
            <div id="adminOrderDetail-thaotac">
                <div style="display:flex; flex-direction: column; justify-content: center; width:auto; min-width:300px; padding-right:30px;">
                    <div style="display:flex; justify-content: space-between;">
                        <span>Tổng giá trị: </span>
                        <span id="adminOrderDetail-total" class="money-amount">${new Intl.NumberFormat('vi-VN').format(donHang.TongGiaTri)} đ</span>
                    </div>
                    <div style="display:flex; justify-content: space-between;">
                        <span>Giảm giá: </span>
                        <span id="adminOrderDetail-discount" class="money-amount">${new Intl.NumberFormat('vi-VN').format(donHang.TienGiamGia)} đ</span>
                    </div>
                    <div style="display:flex; justify-content: space-between;">
                        <span>Thanh toán: </span>
                        <span id="adminOrderDetail-final" class="money-amount">${new Intl.NumberFormat('vi-VN').format(donHang.TongThanhToan)} đ</span>
                    </div>
                </div>
            </div>
            
            <div id="adminOrderDetail-listSanPham" style="max-height: 50vh; overflow-y: auto;">
                    <div class="adminOrderDetail-item">
                        <div class="adminOrderDetail-item-img" style="font-size: 22px;">Sản Phẩm</div>
                        <div class="adminOrderDetail-item-name"></div>
                        <div class="adminOrderDetail-item-price">Đơn Giá</div>
                        <div class="adminOrderDetail-item-quantity-change" style="font-size:20px;">Số Lượng</div>
                        <div class="adminOrderDetail-item-total-price"><p>Thành Tiền</p></div>
                        <div class="adminOrderDetail-item-remove"></div>
                    </div>
                ${chiTietDonHang.map(c => `
                    <div class="adminOrderDetail-item">
                        <img src="${c.AnhSP}" alt="Ảnh Sản Phẩm">
                        <div class="adminOrderDetail-item-name">
                            <p>${c.TenSP}</p>
                        </div>
                        <div class="adminOrderDetail-item-price">
                            <p>${new Intl.NumberFormat('vi-VN').format(c.GiaLucMua)} đ</p>
                        </div>
                        <div class="adminOrderDetail-item-quantity-change">
                            <span  style="font-size:20px;">${c.SoLuong}</span>
                        </div>
                        <div class="adminOrderDetail-item-total-price">
                            <p>${new Intl.NumberFormat('vi-VN').format(c.ThanhTien)} đ</p>
                        </div>
                    </div>`).join('')}
            </div>
        </div>`;
        modal.innerHTML = inner;
        modal.style.display = 'block';
                  } else {
                        customAlert("Không có dữ liệu để hiển thị !");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
}
function closeChiTietDonHang() {
      let modal = document.getElementById("modal-chiTietDonHang");
      modal.innerHTML = "";
      modal.style.display = 'none';
}
function capNhatTrangThai(MaDH, MaTK) {
    let trangThaiMoi = document.getElementById("updateTrangThai").value;
    if(trangThaiMoi == "") {
        customAlert("Vui lòng chọn trạng thái hợp lệ để cập nhật !");
        return;
    }
    $.ajax({
        url: "Controller/DonHangController.php",
        method: "POST",
        data: {
            action: "updateTrangThaiDonHang",
            MaDH: MaDH,
            MaTK: MaTK,
            TrangThaiMoi: trangThaiMoi
        },
        success: function(response) {
            if (response.match(/^success/)) {
                customAlert("Cập nhật trạng thái thành công, đã gửi thông báo cho khách hàng!", "success");
                setTimeout(() => {
                      window.location.reload();
                }, 1000); // 1000 ms = 1 giây
            } else {
                console.log(response);
                customAlert("Cập nhật thất bại: " + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            customAlert("Lỗi khi cập nhật trạng thái.");
        }
    });
}
function locDonHangTheoTrangThai() {
    let selectedStatus = document.getElementById("filter-status").value;
    console.log(selectedStatus)
    // Gửi AJAX request để lấy đơn hàng theo trạng thái
    $.ajax({
        url: "Controller/DonHangController.php",  // Đường dẫn đến Controller xử lý
        type: "POST",
        data: { 
            action: "filter_DonHang", 
            status: selectedStatus,
        },
        success: function (response) {
            document.querySelector("#DonHang-table tbody").innerHTML = response; // Cập nhật bảng
        },
        error: function () {
            document.querySelector("#DonHang-table tbody").innerHTML = "<tr><td colspan='8'>Lỗi khi tải đơn hàng</td></tr>";
        }
    });
}