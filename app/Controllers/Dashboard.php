<?php

namespace App\Controllers;

use Config\Database;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = Database::connect();

        // ================= TODAY REVENUE =================
        $today = $db->query("
            SELECT SUM(d.jumlah * i.harga) AS total
            FROM tbl_transaksi t
            JOIN tbl_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN tbl_item i ON d.id_item = i.id_item
            WHERE DATE(t.tgl_transaksi) = CURDATE()
        ")->getRow();

        // ================= MONTHLY REVENUE =================
        $month = $db->query("
            SELECT SUM(d.jumlah * i.harga) AS total
            FROM tbl_transaksi t
            JOIN tbl_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN tbl_item i ON d.id_item = i.id_item
            WHERE MONTH(t.tgl_transaksi) = MONTH(CURDATE())
            AND YEAR(t.tgl_transaksi) = YEAR(CURDATE())
        ")->getRow();

        // ================= TOTAL ORDERS =================
        $orders = $db->query("
            SELECT COUNT(*) AS total_orders FROM tbl_transaksi
        ")->getRow();

        // ================= REVENUE TREND 7 DAYS =================
        $trend = $db->query("
            SELECT DATE(t.tgl_transaksi) AS tanggal,
                   SUM(d.jumlah * i.harga) AS total
            FROM tbl_transaksi t
            JOIN tbl_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN tbl_item i ON d.id_item = i.id_item
            WHERE t.tgl_transaksi >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY DATE(t.tgl_transaksi)
            ORDER BY tanggal ASC
        ")->getResultArray();

        // ================= DAILY ORDER TREND =================
        $dailyTrend = $db->query("
            SELECT DATE(t.tgl_transaksi) AS tanggal,
                   COUNT(t.id_transaksi) AS total_order
            FROM tbl_transaksi t
            WHERE t.tgl_transaksi >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY DATE(t.tgl_transaksi)
            ORDER BY tanggal ASC
        ")->getResultArray();

        // ================= SALES BY CATEGORY =================
        $category = $db->query("
            SELECT k.nama_kategori, SUM(d.jumlah) AS total
            FROM tbl_detail_transaksi d
            JOIN tbl_item i ON d.id_item = i.id_item
            JOIN tbl_kategori k ON i.id_kategori = k.id_kategori
            GROUP BY k.nama_kategori
        ")->getResultArray();

        // ================= DATA TO VIEW =================
        $data = [
            'todayRevenue'   => $today->total ?? 0,
            'monthlyRevenue' => $month->total ?? 0,
            'totalOrders'    => $orders->total_orders ?? 0,
            'trend'           => $trend,
            'dailyTrend'      => $dailyTrend,
            'category'        => $category
        ];

        // LOAD VIEW LAYOUT
        echo view('part_adm/header');
        echo view('part_adm/top_menu');
        echo view('part_adm/side_menu');
        echo view('dashboard', $data);
        echo view('part_adm/footer');
    }
}