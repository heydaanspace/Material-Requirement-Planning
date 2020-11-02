-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 06:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astodayagiri_mrpv10`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_material`
--

CREATE TABLE `bill_of_material` (
  `bom_code` int(20) NOT NULL,
  `product_sku` char(20) NOT NULL,
  `material_sku` char(20) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_of_material`
--

INSERT INTO `bill_of_material` (`bom_code`, `product_sku`, `material_sku`, `qty`) VALUES
(39, 'PSV01', 'PSV01F', 0.83),
(40, 'PSV01', 'PSV02F', 0.3),
(41, 'PSV01', 'PSV01A', 1.1),
(42, 'PSV01', 'PSV03A', 5),
(43, 'PSV02', 'PSV01F', 0.9),
(44, 'PSV02', 'PSV02F', 0.8),
(45, 'PSV02', 'PSV01A', 1.5),
(46, 'PSV02', 'PSV03A', 5),
(47, 'PSV03', 'PSV01F', 0.9),
(48, 'PSV03', 'PSV02A', 0.5),
(49, 'PSV03', 'PSV04A', 4),
(56, 'PSNV01', 'MSNV01', 0.32),
(57, 'PSNV01', 'MSNV02', 0.145),
(58, 'PSNV01', 'MSNV03', 0.168),
(59, 'PSNV01', 'MSNV04', 0.23),
(60, 'PSNV01', 'MSNV05', 1.08),
(61, 'PSNV01', 'MSNV06', 0.8),
(62, 'PSNV01', 'MSV01', 5.07),
(63, 'PSNV01', 'MSV02', 2.76),
(64, 'PSNV01', 'MSNV07', 1.24),
(65, 'PSNV01', 'MSNV08', 1),
(66, 'PSNV01', 'MSNV09', 5),
(67, 'PSNV01', 'MSNV10', 4),
(68, 'PSNV01', 'MSNV11', 2),
(69, 'PSNV01', 'MSNV12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `configuration_app`
--

CREATE TABLE `configuration_app` (
  `conf_id` int(10) NOT NULL,
  `website_name` varchar(100) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `favicon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configuration_app`
--

INSERT INTO `configuration_app` (`conf_id`, `website_name`, `logo`, `favicon`) VALUES
(1, 'MRP APPS', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` char(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `customer_telp` char(20) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `brand_name`, `customer_telp`, `customer_email`, `customer_address`, `keterangan`) VALUES
('5f7abfc4b4837', 'Danang Stiawan', 'Consina', '087830772771', 'heydaans19@gmail.com', 'Rogoyudan, Sleman.', 'Mitra MoU'),
('5f80074234451', 'Della Lavenia', 'Della\'s Bag', '081392017258', 'della.lavenia100@gmail.com', 'Bintaro Sektor 3A', 'MoU'),
('5f88632cecfda', 'Peres Ariranto Pangabean', 'Leuser Adventure', '085727222252', 'leusertherock@gmail.com', 'Jl. Margonda Raya No.274 B, Kemiri Muka, Kecamatan Beji, Kota Depok, Jawa Barat 16423', 'Mitra'),
('5f944f4d6af9e', 'Yopan Tri Muza', 'Rex Adventure', '081278524172', 'yopantrimuza@gmail.com', 'Kabupaten Liwa, Lampung Timur.', 'Mitra'),
('5f944fbf97041', 'Galih Pratama', 'Outful Co.', '081215725608', 'outful.business@gmail.com', 'Ngawean, Trihanggo, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291', 'Mitra');

-- --------------------------------------------------------

--
-- Table structure for table `detail_manufacturing_order`
--

CREATE TABLE `detail_manufacturing_order` (
  `id_det_mo` int(20) NOT NULL,
  `product_sku` char(20) NOT NULL,
  `mo_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_manufacturing_order`
--

INSERT INTO `detail_manufacturing_order` (`id_det_mo`, `product_sku`, `mo_id`, `quantity`) VALUES
(70, 'PSNV01', 29, 600),
(74, 'PSV01', 30, 50),
(75, 'PSV03', 30, 20);

-- --------------------------------------------------------

--
-- Table structure for table `detail_mrp`
--

CREATE TABLE `detail_mrp` (
  `id_det_mrp` int(11) NOT NULL,
  `id_det_mo` int(20) NOT NULL,
  `bom_code` int(20) NOT NULL,
  `mrp_id` int(20) NOT NULL,
  `gross_req` float NOT NULL,
  `net_req` float NOT NULL,
  `PORel` date NOT NULL,
  `qty_PORel` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_po`
--

CREATE TABLE `detail_po` (
  `id_det_po` int(20) NOT NULL,
  `inv_id` int(20) NOT NULL,
  `po_id` int(20) NOT NULL,
  `supplier_id` char(20) NOT NULL,
  `quantity_po` int(20) NOT NULL,
  `schedule_receipt` date NOT NULL,
  `status_po` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_po`
--

INSERT INTO `detail_po` (`id_det_po`, `inv_id`, `po_id`, `supplier_id`, `quantity_po`, `schedule_receipt`, `status_po`) VALUES
(67, 20, 29, '5f193832c2', 20, '2020-10-14', 'Sudah diterima'),
(68, 22, 29, '5f193832c2', 5, '2020-10-13', 'Sudah diterima'),
(69, 24, 29, '696y', 100, '2020-10-13', 'Sudah diterima'),
(74, 26, 31, '5f193832c2', 10, '2020-10-15', 'Sudah diterima'),
(75, 28, 32, '5f193832c2', 30, '2020-03-21', 'Belum diterima'),
(77, 37, 33, '696y', 10, '2020-03-23', 'Belum diterima'),
(78, 44, 34, '5f193832c2', 100, '2020-03-24', 'Belum diterima'),
(80, 20, 36, '5f193832c2', 9, '2020-10-25', 'Belum diterima');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock`
--

CREATE TABLE `inventory_stock` (
  `inv_id` int(20) NOT NULL,
  `material_sku` char(20) NOT NULL,
  `quantity` int(10) NOT NULL,
  `value_in_stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_stock`
--

INSERT INTO `inventory_stock` (`inv_id`, `material_sku`, `quantity`, `value_in_stock`) VALUES
(20, 'PSV01F', 19, 262500),
(21, 'PSV02F', 0, 175000),
(22, 'PSV01A', 0, 60000),
(23, 'PSV02A', 0, 60000),
(24, 'PSV03A', 50, 50000),
(25, 'PSV04A', 20, 0),
(26, 'MSV01F', 15, 150000),
(27, 'MSV02F', 5, 150000),
(28, 'MSNV01', 5, 175000),
(29, 'MSNV02', 10, 200000),
(30, 'MSNV03', 30, 1500000),
(31, 'MSNV04', 6, 210000),
(32, 'MSNV05', 15, 142500),
(33, 'MSNV06', 7, 133000),
(36, 'MSNV07', 17, 51000),
(37, 'MSNV08', 1, 7500),
(38, 'MSNV09', 100, 100000),
(39, 'MSNV10', 57, 114000),
(40, 'MSNV11', 25, 25000),
(41, 'MSNV12', 150, 225000),
(44, 'MSV01', 50, 0),
(45, 'MSV02', 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturing_order`
--

CREATE TABLE `manufacturing_order` (
  `mo_id` int(20) NOT NULL,
  `mo_code` char(50) NOT NULL,
  `customer_id` char(20) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `production_start` date NOT NULL,
  `prod_deadline` varchar(20) NOT NULL,
  `production_cost` int(20) NOT NULL,
  `total_cost` int(10) NOT NULL,
  `additional_info` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manufacturing_order`
--

INSERT INTO `manufacturing_order` (`mo_id`, `mo_code`, `customer_id`, `created_date`, `production_start`, `prod_deadline`, `production_cost`, `total_cost`, `additional_info`, `status`) VALUES
(29, 'PROD-151020-03', '5f88632cecfda', '15-10-2020', '2020-03-24', '2020-04-07', 500000, 33500000, 'Include material', 'Belum dilaksanakan'),
(30, 'PROD-231020-04', '5f7abfc4b4837', '23-10-2020', '2020-10-26', '2020-11-04', 200000, 15200000, 'Include', 'Belum dilaksanakan');

-- --------------------------------------------------------

--
-- Table structure for table `master_variant_material`
--

CREATE TABLE `master_variant_material` (
  `mvm_id` int(11) NOT NULL,
  `variant_material` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_variant_material`
--

INSERT INTO `master_variant_material` (`mvm_id`, `variant_material`) VALUES
(1, 'Warna'),
(2, 'Kapasitas'),
(5, 'Jenis'),
(6, 'Ukuran');

-- --------------------------------------------------------

--
-- Table structure for table `master_variant_product`
--

CREATE TABLE `master_variant_product` (
  `variant_id` int(20) NOT NULL,
  `variant_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_variant_product`
--

INSERT INTO `master_variant_product` (`variant_id`, `variant_name`) VALUES
(1, 'Warna'),
(2, 'Kapasitas');

-- --------------------------------------------------------

--
-- Table structure for table `material_category`
--

CREATE TABLE `material_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_category`
--

INSERT INTO `material_category` (`category_id`, `category_name`) VALUES
(1, 'Canvas'),
(2, 'Aksesoris Tas'),
(5, 'Complement'),
(6, 'Sepatu'),
(7, 'Bag'),
(8, 'Lain-lain'),
(9, 'DOM'),
(10, 'Canvas'),
(11, 'Accessoris'),
(12, 'Fabric'),
(13, 'Zipper Component'),
(14, 'Benang');

-- --------------------------------------------------------

--
-- Table structure for table `material_item`
--

CREATE TABLE `material_item` (
  `material_code` int(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `material_name` varchar(100) NOT NULL,
  `material_brand` varchar(100) NOT NULL,
  `material_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_item`
--

INSERT INTO `material_item` (`material_code`, `category_id`, `material_name`, `material_brand`, `material_unit`) VALUES
(19, 12, 'Dolby Fabric', 'Yurex', 'Meter'),
(20, 11, 'Webbing Strap 2.5', 'KTB', 'Meter'),
(21, 11, 'Puller Zipper', 'YKK', 'Pcs'),
(23, 12, 'Polyester Fabric 300D', 'Tidak Ada', 'Meter'),
(24, 12, 'Nylon Dolby PU D217', 'D2117', 'Meter'),
(25, 12, 'Torin Polyester Ripstop / Jaring', 'Torin', 'Meter'),
(26, 12, 'Nylon urek 1256', 'Urek', 'Meter'),
(27, 12, 'Cover Polyripstop', 'None', 'Meter'),
(28, 12, 'Webbing Strap 20mm pp Grey', 'Polypropylene', 'Meter'),
(29, 12, 'Webbing Strap 38mm pp Grey', 'Polypropylene', 'Meter'),
(30, 11, 'PCR (Bisban)', 'None', 'Meter'),
(31, 13, 'RIT / Zipper 05', 'YKK', 'Meter'),
(32, 14, 'Benang', 'None', 'Roll'),
(33, 13, 'Head Zipper No. 5', 'YKK', 'Pcs'),
(34, 13, 'Puller Zipper', 'YKK', 'Pcs'),
(35, 11, 'Gesper 20mm', 'SRE 3806', 'Pcs'),
(36, 11, 'RIng Jalan 20mm', 'SRE 2', 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `material_sku`
--

CREATE TABLE `material_sku` (
  `sku_id` int(11) NOT NULL,
  `material_sku` char(20) NOT NULL,
  `material_price` int(20) NOT NULL,
  `early_stock` int(20) NOT NULL,
  `leadtime` int(20) NOT NULL,
  `material_code` int(20) NOT NULL,
  `mv_code` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_sku`
--

INSERT INTO `material_sku` (`sku_id`, `material_sku`, `material_price`, `early_stock`, `leadtime`, `material_code`, `mv_code`) VALUES
(43, 'PSV01F', 17500, 0, 2, 19, 56),
(44, 'PSV02F', 17500, 0, 2, 19, 57),
(45, 'PSV01A', 1500, 0, 1, 20, 58),
(46, 'PSV02A', 1500, 0, 1, 20, 59),
(47, 'PSV03A', 1000, 0, 1, 21, 60),
(48, 'PSV04A', 1900, 0, 1, 21, 61),
(49, 'MSV01F', 30000, 5, 2, 23, 64),
(50, 'MSV02F', 30000, 5, 2, 23, 65),
(51, 'MSNV01', 35000, 5, 3, 24, NULL),
(52, 'MSNV02', 20000, 10, 2, 25, NULL),
(53, 'MSNV03', 50000, 30, 2, 26, NULL),
(54, 'MSNV04', 35000, 6, 2, 27, NULL),
(55, 'MSNV05', 9500, 15, 1, 28, NULL),
(56, 'MSNV06', 19000, 7, 1, 29, NULL),
(59, 'MSV01', 600, 0, 2, 30, 74),
(60, 'MSV02', 700, 0, 2, 30, 75),
(61, 'MSNV07', 3000, 17, 1, 31, NULL),
(62, 'MSNV08', 7500, 1, 1, 32, NULL),
(63, 'MSNV09', 1000, 100, 1, 33, NULL),
(64, 'MSNV10', 2000, 57, 1, 34, NULL),
(65, 'MSNV11', 1000, 25, 1, 35, NULL),
(66, 'MSNV12', 1500, 150, 1, 36, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_variant`
--

CREATE TABLE `material_variant` (
  `mv_code` int(20) NOT NULL,
  `material_code` int(20) NOT NULL,
  `mv_option` varchar(50) NOT NULL,
  `mv_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_variant`
--

INSERT INTO `material_variant` (`mv_code`, `material_code`, `mv_option`, `mv_value`) VALUES
(56, 19, 'Warna', 'Black'),
(57, 19, 'Warna', 'Green'),
(58, 20, 'Warna', 'Black'),
(59, 20, 'Warna', 'Green'),
(60, 21, 'Jenis', 'Tali'),
(61, 21, 'Jenis', 'Metal'),
(64, 23, 'Warna', 'Blue'),
(65, 23, 'Warna', 'Light Green'),
(66, 24, 'Ukuran', ''),
(67, 25, 'Ukuran', ''),
(68, 26, 'Ukuran', ''),
(69, 27, 'Ukuran', ''),
(70, 28, 'Ukuran', ''),
(71, 29, 'Ukuran', ''),
(74, 30, 'Ukuran', '2.0 CM'),
(75, 30, 'Ukuran', '2.2 CM'),
(76, 31, 'Ukuran', ''),
(77, 32, 'Ukuran', ''),
(78, 33, 'Ukuran', ''),
(79, 34, 'Ukuran', ''),
(80, 35, 'Ukuran', ''),
(81, 36, 'Ukuran', '');

-- --------------------------------------------------------

--
-- Table structure for table `mrp`
--

CREATE TABLE `mrp` (
  `mrp_id` int(20) NOT NULL,
  `mrp_code` char(20) NOT NULL,
  `created_date` date NOT NULL,
  `set_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mrp`
--

INSERT INTO `mrp` (`mrp_id`, `mrp_code`, `created_date`, `set_by`) VALUES
(27, 'MRP-231020-01', '2020-10-23', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` int(20) NOT NULL,
  `category_id` int(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `category_id`, `product_name`, `product_brand`, `unit`) VALUES
(131, 16, 'Carrier', 'Consina', 'Pcs'),
(134, 16, 'Waist Bag', 'Della\'s Bag', 'Pcs'),
(135, 16, 'Tas Lipat Arkansas', 'Leuser', 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`) VALUES
(1, 'Bag'),
(2, 'Outdoor Equipment'),
(3, 'DOM'),
(4, 'Sepatu'),
(8, 'Accesoris'),
(12, 'DOM'),
(16, 'Bag');

-- --------------------------------------------------------

--
-- Table structure for table `product_sku`
--

CREATE TABLE `product_sku` (
  `sku_id` int(11) NOT NULL,
  `product_sku` char(20) NOT NULL,
  `sales_price` int(10) NOT NULL,
  `product_code` int(20) NOT NULL,
  `variant_code` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_sku`
--

INSERT INTO `product_sku` (`sku_id`, `product_sku`, `sales_price`, `product_code`, `variant_code`) VALUES
(131, 'PSV01', 300000, 131, 85),
(132, 'PSV02', 350000, 131, 86),
(134, 'PSV03', 50000, 134, 89),
(135, 'PSV04', 50000, 134, 90),
(136, 'PSNV01', 55000, 135, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `variant_code` int(20) NOT NULL,
  `product_code` int(20) NOT NULL,
  `variant_option` varchar(50) NOT NULL,
  `option_value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`variant_code`, `product_code`, `variant_option`, `option_value`) VALUES
(85, 131, 'Kapasitas', '5 Liter'),
(86, 131, 'Kapasitas', '10 Liter'),
(89, 134, 'Warna', 'Black'),
(90, 134, 'Warna', 'Green'),
(91, 135, 'Kapasitas', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` int(20) NOT NULL,
  `po_code` char(20) NOT NULL,
  `created_date` date NOT NULL,
  `po_type` varchar(50) NOT NULL,
  `total_cost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `po_code`, `created_date`, `po_type`, `total_cost`) VALUES
(29, 'PO-121020-01', '2020-10-12', 'Non Rujukan', 457500),
(31, 'PO-131020-02', '2020-10-13', 'Non Rujukan', 300000),
(32, 'PO-151020-03', '2020-10-15', 'Non Rujukan', 1050000),
(33, 'PO-201020-04', '2020-10-20', 'Non Rujukan', 75000),
(34, 'PO-201020-05', '2020-10-20', 'Non Rujukan', 60000),
(36, 'PO-231020-06', '2020-10-23', 'Non Rujukan', 210000);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `name`, `description`) VALUES
(1, 'KaBag. Produksi', 'Mengelola semua kegiatan produksi dan material'),
(2, 'Staff Produksi', 'Mengelola dan menjalankan perintah pembelian material'),
(3, 'Pimpinan', 'Memantau laporan kegiatan produksi dan material');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` char(20) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `supplier_telp` char(20) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `owner_name`, `supplier_telp`, `supplier_email`, `supplier_address`) VALUES
('5f193832c2', 'King Tex', 'King Tex', '2147483647', 'kingtex_outlet@gmail.com', 'Jl. HOS Cokroaminoto No.136, Tegalrejo, Kec. Tegalrejo, Kota Yogyakarta, Daerah Istimewa Yogyakarta '),
('5f93f99802d98', 'Anugerah tex', 'Tn. Anugerah', '274560594', 'anugerahjogja@gmail.com', '                    Jl. R. E. Martadinata No.20, Pakuncen, Wirobrajan, Kota Yogyakarta, Daerah Istim'),
('696y', 'Primatama Tex', 'Tn. Sumargo', '2857654', 'prism.tex@gmail.com', '                    Jalan sipacar, Wiradesa, Kab. Pemalang                                          ');

-- --------------------------------------------------------

--
-- Table structure for table `unit_of_measure`
--

CREATE TABLE `unit_of_measure` (
  `id_unit` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_of_measure`
--

INSERT INTO `unit_of_measure` (`id_unit`, `unit_name`) VALUES
(1, 'Pcs'),
(2, 'Meter'),
(3, 'Centimeters'),
(5, 'Roll'),
(6, 'Yard');

-- --------------------------------------------------------

--
-- Table structure for table `user_system`
--

CREATE TABLE `user_system` (
  `user_id` int(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `is_active` tinyint(10) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_system`
--

INSERT INTO `user_system` (`user_id`, `fullname`, `email`, `username`, `password`, `address`, `no_telp`, `is_active`, `created_date`, `last_login`, `id_role`) VALUES
(1, 'ike Asto', 'ikkeasto@owner.com', 'ikkeasto', '$2y$10$yHfAi6FLC6iVq.eieklVROz82wkJv/EOQTzRbnMg6rCgusOOx/HFO', 'Perum Nogotirto V, Mlangi, Nogotirto, Gamping, Sleman Regency, Special Region of Yogyakarta 55291', '087830772772', 1, '0000-00-00 00:00:00', '2020-10-25 12:42:09', 3),
(2, 'Danang Stiawan', 'danang@production.com', 'heydaans', '$2y$10$1nms9EDYwkW9GadwsMy0UeogRuSe9v9iUisBTUOlH1m7tuKIDbm.S', 'Pekalongan', '087830772771', 1, '2020-03-13 22:13:40', '2020-10-25 12:36:38', 1),
(3, 'John Doe', 'john@staff.com', 'johndoe', '$2y$10$xV4O6OUfx1wCBp1H4RGreOch/VuHOtzTyXgY1ebG9dSJAeNJGMc62', 'Jogja', '087830772771', 1, '2020-03-13 22:13:40', '2020-10-25 12:39:43', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_of_material`
--
ALTER TABLE `bill_of_material`
  ADD PRIMARY KEY (`bom_code`),
  ADD KEY `variant_code` (`product_sku`),
  ADD KEY `material_sku` (`material_sku`);

--
-- Indexes for table `configuration_app`
--
ALTER TABLE `configuration_app`
  ADD PRIMARY KEY (`conf_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `detail_manufacturing_order`
--
ALTER TABLE `detail_manufacturing_order`
  ADD PRIMARY KEY (`id_det_mo`),
  ADD KEY `product_sku` (`product_sku`),
  ADD KEY `mo_id` (`mo_id`);

--
-- Indexes for table `detail_mrp`
--
ALTER TABLE `detail_mrp`
  ADD PRIMARY KEY (`id_det_mrp`),
  ADD KEY `id_det_mo` (`id_det_mo`),
  ADD KEY `bom_code` (`bom_code`),
  ADD KEY `mrp_id` (`mrp_id`);

--
-- Indexes for table `detail_po`
--
ALTER TABLE `detail_po`
  ADD PRIMARY KEY (`id_det_po`),
  ADD KEY `inv_id` (`inv_id`),
  ADD KEY `po_id` (`po_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `material_sku` (`material_sku`);

--
-- Indexes for table `manufacturing_order`
--
ALTER TABLE `manufacturing_order`
  ADD PRIMARY KEY (`mo_id`),
  ADD UNIQUE KEY `mo_code` (`mo_code`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `master_variant_material`
--
ALTER TABLE `master_variant_material`
  ADD PRIMARY KEY (`mvm_id`);

--
-- Indexes for table `master_variant_product`
--
ALTER TABLE `master_variant_product`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `material_category`
--
ALTER TABLE `material_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `material_item`
--
ALTER TABLE `material_item`
  ADD PRIMARY KEY (`material_code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `material_sku`
--
ALTER TABLE `material_sku`
  ADD PRIMARY KEY (`sku_id`),
  ADD UNIQUE KEY `material_sku` (`material_sku`),
  ADD KEY `matarial_code` (`material_code`),
  ADD KEY `mv_code` (`mv_code`);

--
-- Indexes for table `material_variant`
--
ALTER TABLE `material_variant`
  ADD PRIMARY KEY (`mv_code`),
  ADD KEY `material_code` (`material_code`);

--
-- Indexes for table `mrp`
--
ALTER TABLE `mrp`
  ADD PRIMARY KEY (`mrp_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_sku`
--
ALTER TABLE `product_sku`
  ADD PRIMARY KEY (`sku_id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `variant_code` (`variant_code`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`variant_code`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`),
  ADD UNIQUE KEY `po_code` (`po_code`),
  ADD KEY `inv_id` (`po_code`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `unit_of_measure`
--
ALTER TABLE `unit_of_measure`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `user_system`
--
ALTER TABLE `user_system`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_of_material`
--
ALTER TABLE `bill_of_material`
  MODIFY `bom_code` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `detail_manufacturing_order`
--
ALTER TABLE `detail_manufacturing_order`
  MODIFY `id_det_mo` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `detail_mrp`
--
ALTER TABLE `detail_mrp`
  MODIFY `id_det_mrp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `detail_po`
--
ALTER TABLE `detail_po`
  MODIFY `id_det_po` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  MODIFY `inv_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `manufacturing_order`
--
ALTER TABLE `manufacturing_order`
  MODIFY `mo_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `master_variant_material`
--
ALTER TABLE `master_variant_material`
  MODIFY `mvm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_variant_product`
--
ALTER TABLE `master_variant_product`
  MODIFY `variant_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `material_category`
--
ALTER TABLE `material_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `material_item`
--
ALTER TABLE `material_item`
  MODIFY `material_code` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `material_sku`
--
ALTER TABLE `material_sku`
  MODIFY `sku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `material_variant`
--
ALTER TABLE `material_variant`
  MODIFY `mv_code` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `mrp`
--
ALTER TABLE `mrp`
  MODIFY `mrp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_code` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_sku`
--
ALTER TABLE `product_sku`
  MODIFY `sku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `variant_code` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `po_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `unit_of_measure`
--
ALTER TABLE `unit_of_measure`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_system`
--
ALTER TABLE `user_system`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_of_material`
--
ALTER TABLE `bill_of_material`
  ADD CONSTRAINT `bill_of_material_ibfk_1` FOREIGN KEY (`product_sku`) REFERENCES `product_sku` (`product_sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_of_material_ibfk_2` FOREIGN KEY (`material_sku`) REFERENCES `material_sku` (`material_sku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_manufacturing_order`
--
ALTER TABLE `detail_manufacturing_order`
  ADD CONSTRAINT `detail_manufacturing_order_ibfk_1` FOREIGN KEY (`product_sku`) REFERENCES `product_sku` (`product_sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_manufacturing_order_ibfk_2` FOREIGN KEY (`mo_id`) REFERENCES `manufacturing_order` (`mo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_mrp`
--
ALTER TABLE `detail_mrp`
  ADD CONSTRAINT `detail_mrp_ibfk_1` FOREIGN KEY (`id_det_mo`) REFERENCES `detail_manufacturing_order` (`id_det_mo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_mrp_ibfk_2` FOREIGN KEY (`mrp_id`) REFERENCES `mrp` (`mrp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_mrp_ibfk_3` FOREIGN KEY (`bom_code`) REFERENCES `bill_of_material` (`bom_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_po`
--
ALTER TABLE `detail_po`
  ADD CONSTRAINT `detail_po_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `inventory_stock` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_po_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_po_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  ADD CONSTRAINT `inventory_stock_ibfk_1` FOREIGN KEY (`material_sku`) REFERENCES `material_sku` (`material_sku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufacturing_order`
--
ALTER TABLE `manufacturing_order`
  ADD CONSTRAINT `manufacturing_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_item`
--
ALTER TABLE `material_item`
  ADD CONSTRAINT `material_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `material_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_sku`
--
ALTER TABLE `material_sku`
  ADD CONSTRAINT `material_sku_ibfk_1` FOREIGN KEY (`material_code`) REFERENCES `material_item` (`material_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_sku_ibfk_2` FOREIGN KEY (`mv_code`) REFERENCES `material_variant` (`mv_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_variant`
--
ALTER TABLE `material_variant`
  ADD CONSTRAINT `material_variant_ibfk_1` FOREIGN KEY (`material_code`) REFERENCES `material_item` (`material_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_sku`
--
ALTER TABLE `product_sku`
  ADD CONSTRAINT `product_sku_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sku_ibfk_2` FOREIGN KEY (`variant_code`) REFERENCES `product_variant` (`variant_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_system`
--
ALTER TABLE `user_system`
  ADD CONSTRAINT `user_system_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
