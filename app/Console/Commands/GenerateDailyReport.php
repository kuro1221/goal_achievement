<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDF;

class GenerateDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:generate-daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Report';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $report_date = $this->getReportDate();
        $sales_data = $this->getSalesData($report_date);
        Log::info($sales_data);
        $pdf = $this->generateSalesReport($sales_data);
        $this->saveReport($pdf, $report_date);
    }

    public function getSalesData(Carbon $report_date)
    {
        $a = $report_date->format('Y-m-d');
        $sales_data = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount, SUM(total_qty) as total_qty')
            ->whereDate('created_at', $report_date->format('Y-m-d'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return $sales_data;
    }

    // 前日を取得する（週末の場合は前営業日）
    public function getReportDate(): Carbon
    {
        $today = Carbon::today();

        if ($today->isWeekday()) {
            return $today->subWeekday();
        }

        return $today->subDay();
    }

    public function generateSalesReport($sales_data)
    {
        $sales_data = json_decode($sales_data)[0];
        // 売上レポート用のビューを作成してデータを渡す
        $view = view('sales_report', compact('sales_data'));

        // DomPDFを使用してPDFを生成
        $pdf = PDF::loadHTML($view->render());

        return $pdf;
    }

    public function saveReport($pdf, $report_date)
    {
        $directory = storage_path('app/reports');

        // ディレクトリ存在しない場合は作成
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        // ファイル名を作成 (sales_report_2023-04-14.pdf)
        $filename = sprintf('sales_report_%s.pdf', $report_date->format('Y-m-d'));

        // PDFを保存
        $pdf->save($directory . '/' . $filename);
    }
}
