<?php
require (__DIR__ . "/../Model/SanPhamModel.php");
require (__DIR__ . "/../../Resource/configCloudinary.php");
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
class SanPhamController {
      private $SanPhamModel;

      public function __construct() {
            $this->SanPhamModel = new SanPhamModel();
      }
      public function showSanPhamView() {
            $listSanPham = $this->SanPhamModel->getAll();
            $loaiSP = $this->SanPhamModel->getAllLoaiSP();
            require(__DIR__."/../View/SanPhamView.php");
      }
      // public function themSP() {
      //       $TenSP = $_POST['TenSP'];
      //       // $AnhSP = $_POST['AnhSP'];
      //       $GiaSP = $_POST['GiaSP'];
      //       $MoTaSP = $_POST['MoTaSP'];
      //       $LoaiSP = isset($_POST['LoaiSPData']) ? $_POST['LoaiSPData'] : [];
      //       if (isset($_FILES['AnhSP'])) {
      //           $errors = array();
      //           $file_name = $_FILES['AnhSP']['name'];
      //           $file_size = $_FILES['AnhSP']['size'];
      //           $file_tmp = $_FILES['AnhSP']['tmp_name'];
      //           $file_type = $_FILES['AnhSP']['type'];
      //           $file_parts = explode('.', $_FILES['AnhSP']['name']);
      //           $file_ext = strtolower(end($file_parts));
      //           $expensions = array("jpeg", "jpg", "png");
        
      //           if (in_array($file_ext, $expensions) === false) {
      //               $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
      //           }
        
      //       //     if ($file_size > 2097152) {
      //       //         $errors[] = 'Kích thước file không được lớn hơn 2MB';
      //       //     }
        
      //           if (empty($errors)) {
      //             //   $image = $_FILES['addSP-anh']['name'];
      //                   $newID = $this->SanPhamModel->createNewMaSP();
      //                   $new_filename = $newID . '.' . $file_ext;
      //                   $target = "../../IMG/SanPham/" . $new_filename;
            
      //                   if (move_uploaded_file($file_tmp, $target)) {
        
        
      //                   // Cập nhật cơ sở dữ liệu
                       
      //                   if ($this->SanPhamModel->themSanPham($TenSP, $new_filename, $GiaSP, $MoTaSP)) {
      //                         if (!empty($LoaiSP)) {
      //                               foreach ($LoaiSP as $loaiSP) {
      //                                   if (!$this->SanPhamModel->themLoaiSP($newID, $loaiSP)) {
      //                                       echo "Lỗi khi thêm loại sản phẩm.";
      //                                       return;
      //                                   }
      //                               }
      //                         }
      //                         echo "success";
      //                   } else {
      //                       echo "error";
      //                   }
      //               } else {
      //                   echo "error_upload";
      //               }
      //           } else {
      //               foreach ($errors as $error) {
      //                   echo $error . "<br>";
      //               }
      //           }
      //       }
      // }

      public function themSP() {
            $TenSP = $_POST['TenSP'];
            $GiaSP = $_POST['GiaSP'];
            $MoTaSP = $_POST['MoTaSP'];
            $LoaiSP = isset($_POST['LoaiSPData']) ? $_POST['LoaiSPData'] : [];
        
            if (isset($_FILES['AnhSP'])) {
                $errors = array();
                $file_tmp = $_FILES['AnhSP']['tmp_name'];
                $file_parts = explode('.', $_FILES['AnhSP']['name']);
                $file_ext = strtolower(end($file_parts));
                $expensions = array("jpeg", "jpg", "png");
        
                if (!in_array($file_ext, $expensions)) {
                    $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
                }
        
                if (empty($errors)) {
                    $newID = $this->SanPhamModel->createNewMaSP();
                    $new_filename = "sanpham_" . $newID; // Định danh file mới
        
                    try {
                        // Upload ảnh lên Cloudinary
                        $upload = (new UploadApi())->upload($file_tmp, [
                            'folder' => 'GiftShopSanPham',
                            'public_id' => $new_filename,
                            'overwrite' => true, // Ghi đè nếu trùng tên
                            'transformation' => [
                                  ['width' => 600, 'height' => 600, 'crop' => 'fill', 'gravity' => 'auto']
                            ]
                        ]);
        
                        $image_url = $upload['secure_url']; // Lấy URL của ảnh từ Cloudinary
        
                        // Cập nhật cơ sở dữ liệu với URL ảnh từ Cloudinary
                        if ($this->SanPhamModel->themSanPham($TenSP, $image_url, $GiaSP, $MoTaSP)) {
                            if (!empty($LoaiSP)) {
                                foreach ($LoaiSP as $loaiSP) {
                                    if (!$this->SanPhamModel->themLoaiSP($newID, $loaiSP)) {
                                        echo "Lỗi khi thêm loại sản phẩm.";
                                        return;
                                    }
                                }
                            }
                            echo "success";
                        } else {
                            echo "error";
                        }
                    } catch (Exception $e) {
                        echo "Lỗi upload ảnh: " . $e->getMessage();
                    }
                } else {
                    foreach ($errors as $error) {
                        echo $error . "<br>";
                    }
                }
            }
        }
      // public function suaSP() {
      //       $MaSP = $_POST['MaSP'];
      //       $TenSP = $_POST['TenSP'];
      //       // $AnhSP = $_POST['AnhSP'];
      //       $GiaSP = $_POST['GiaSP'];
      //       $MoTaSP = $_POST['MoTaSP'];
      //       $LoaiSP = isset($_POST['LoaiSPData']) ? $_POST['LoaiSPData'] : [];
      //       if (isset($_FILES['AnhSP'])) {
      //           $errors = array();
      //           $file_name = $_FILES['AnhSP']['name'];
      //           $file_size = $_FILES['AnhSP']['size'];
      //           $file_tmp = $_FILES['AnhSP']['tmp_name'];
      //           $file_type = $_FILES['AnhSP']['type'];
      //           $file_parts = explode('.', $_FILES['AnhSP']['name']);
      //           $file_ext = strtolower(end($file_parts));
      //           $expensions = array("jpeg", "jpg", "png");
        
      //           if (in_array($file_ext, $expensions) === false) {
      //               $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
      //           }
        
      //       //     if ($file_size > 2097152) {
      //       //         $errors[] = 'Kích thước file không được lớn hơn 2MB';
      //       //     }
        
      //           if (empty($errors)) {
      //             //   $image = $_FILES['addSP-anh']['name'];
      //                   $new_filename = $MaSP . '.' . $file_ext;
      //               $target = "../../IMG/SanPham/" . $new_filename;
        
      //               if (move_uploaded_file($file_tmp, $target)) {
        
        
      //                   // Cập nhật cơ sở dữ liệu
                       
      //                   if ( $this->SanPhamModel->suaSanPham($MaSP,$TenSP, $new_filename, $GiaSP, $MoTaSP)){
      //                         if (!empty($LoaiSP)) {
      //                               if($this->SanPhamModel->xoaLoaiSPByMaSP($MaSP)) {
      //                                     foreach ($LoaiSP as $loaiSP) {
      //                                           if (!$this->SanPhamModel->themLoaiSP($MaSP, $loaiSP)) {
      //                                                 echo "Lỗi khi thêm loại sản phẩm.";
      //                                           return;
      //                                     }
      //                                 }
      //                               }
      //                         }
      //                         echo "success";
      //                   } else {
      //                       echo "error";
      //                   }
      //               } else {
      //                   echo "error_upload";
      //               }
      //           } else {
      //               foreach ($errors as $error) {
      //                   echo $error . "<br>";
      //               }
      //           }
      //       } else {
      //             if ( $this->SanPhamModel->suaSanPhamKhongDoiAnh($MaSP,$TenSP, $GiaSP, $MoTaSP)) {
      //                   if (!empty($LoaiSP)) {
      //                         if($this->SanPhamModel->xoaLoaiSPByMaSP($MaSP)) {
      //                               foreach ($LoaiSP as $loaiSP) {
      //                                     if (!$this->SanPhamModel->themLoaiSP($MaSP, $loaiSP)) {
      //                                           echo "Lỗi khi thêm loại sản phẩm.";
      //                                     return;
      //                               }
      //                           }
      //                         }
      //                   }
      //                   echo "success";
      //             } else {
      //             echo "error";
      //             }
      //       }
      // }

      public function suaSP() {
            $MaSP = $_POST['MaSP'];
            $TenSP = $_POST['TenSP'];
            $GiaSP = $_POST['GiaSP'];
            $MoTaSP = $_POST['MoTaSP'];
            $LoaiSP = isset($_POST['LoaiSPData']) ? $_POST['LoaiSPData'] : [];

            // Lấy ảnh hiện tại từ database để xóa nếu cần
            $oldImage = $this->SanPhamModel->layAnhSanPham($MaSP);

            if (isset($_FILES['AnhSP']) && $_FILES['AnhSP']['size'] > 0) {
                  $errors = array();
                  $file_tmp = $_FILES['AnhSP']['tmp_name'];
                  $file_parts = explode('.', $_FILES['AnhSP']['name']);
                  $file_ext = strtolower(end($file_parts));
                  $expensions = array("jpeg", "jpg", "png");

                  if (!in_array($file_ext, $expensions)) {
                        $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
                  }

                  if (empty($errors)) {
                        $new_filename = "sanpham_" . $MaSP; // Giữ nguyên ID sản phẩm

                        try {
                        // Nếu sản phẩm đã có ảnh, xóa ảnh cũ trên Cloudinary
                        if ($oldImage) {
                              preg_match("/\/v\d+\/GiftShopSanPham\/(.*)\./", $oldImage, $matches);
                              if (!empty($matches[1])) {
                                    $publicId = "GiftShopSanPham/" . $matches[1];
                                    (new AdminApi())->deleteAssets([$publicId]);
                              }
                        }

                        // Upload ảnh mới lên Cloudinary
                        $upload = (new UploadApi())->upload($file_tmp, [
                              'folder' => 'GiftShopSanPham',
                              'public_id' => $new_filename,
                              'overwrite' => true, // Ghi đè ảnh cũ nếu có
                              'transformation' => [
                                    ['width' => 600, 'height' => 600, 'crop' => 'fill', 'gravity' => 'auto']
                              ]
                        ]);

                        $image_url = $upload['secure_url']; // URL ảnh mới từ Cloudinary

                        // Cập nhật cơ sở dữ liệu
                        if ($this->SanPhamModel->suaSanPham($MaSP, $TenSP, $image_url, $GiaSP, $MoTaSP)) {
                              if (!empty($LoaiSP)) {
                                    $this->SanPhamModel->xoaLoaiSPByMaSP($MaSP);
                                    foreach ($LoaiSP as $loaiSP) {
                                    if (!$this->SanPhamModel->themLoaiSP($MaSP, $loaiSP)) {
                                          echo "Lỗi khi thêm loại sản phẩm.";
                                          return;
                                    }
                                    }
                              }
                              echo "success";
                        } else {
                              echo "error";
                        }
                        } catch (Exception $e) {
                        echo "Lỗi upload ảnh: " . $e->getMessage();
                        }
                  } else {
                        foreach ($errors as $error) {
                        echo $error . "<br>";
                        }
                  }
            } else {
                  // Nếu không đổi ảnh, chỉ cập nhật thông tin sản phẩm
                  if ($this->SanPhamModel->suaSanPhamKhongDoiAnh($MaSP, $TenSP, $GiaSP, $MoTaSP)) {
                        if (!empty($LoaiSP)) {
                        $this->SanPhamModel->xoaLoaiSPByMaSP($MaSP);
                        foreach ($LoaiSP as $loaiSP) {
                              if (!$this->SanPhamModel->themLoaiSP($MaSP, $loaiSP)) {
                                    echo "Lỗi khi thêm loại sản phẩm.";
                                    return;
                              }
                        }
                        }
                        echo "success";
                  } else {
                        echo "error";
                  }
            }
            }

      public function xoaSP() {
            $MaSP = $_POST['MaSP'];
            if($this->SanPhamModel->xoaSanPham($MaSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function getLoaiSPByMaSP() {
            $MaSP = $_POST['MaSP'];
            if($result = $this->SanPhamModel->getLoaiSPByMaSP($MaSP)) {
                  echo json_encode(['status' => 'success', 'data' => $result]);
            } else {
                  echo json_encode(['status' => 'success', 'data' => []]);
            }
      }
}
$SanPhamController = new SanPhamController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "add_SP":
                  $SanPhamController->themSP();
                  break;
            case "update_SP":
                  $SanPhamController->suaSP();
                  break;
            case "delete_SP":
                  $SanPhamController->xoaSP();
                  break;
            case "getLoaiSP_SP":
                  $SanPhamController->getLoaiSPByMaSP();
                  break;
      }
} else if(isset($_GET['move'])){
      switch ($_GET['move']) {
            // case "Them":
            //       $PhimController->showThemSanPhamView();
            //       break; 
            default:
                  $SanPhamController->showSanPhamView();
                  break;
      }
} else {
      $SanPhamController->showSanPhamView();
}
