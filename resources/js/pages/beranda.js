import Chart from 'chart.js/auto';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

const pegawai_distribution_chart = document.getElementById('pegawai-distribution-chart');
const prestasi_improvement_chart = document.getElementById('prestasi-improvement-chart');
const prestasi_improvement_tahun_filter_form = document.getElementById('prestasi-improvement-tahun-filter-form');
const prestasi_improvement_tahun_select = document.getElementById('prestasi-improvement-tahun-select');
const semester_calendar = document.getElementById('semester-calendar');

if (pegawai_distribution_chart && prestasi_improvement_chart) {
    let pegawai_distribution_chart_instance = null;
    let prestasi_improvement_chart_instance = null;

    const pegawai_distribution_chart_function = async () => {
        const pegawai_distribution_chart_response = await fetch('/api/pegawai-distribution');
        const pegawai_distribution_chart_data = await pegawai_distribution_chart_response.json();

        if (pegawai_distribution_chart_instance) {
            pegawai_distribution_chart_instance.destroy();
        }

        const pegawai_distribution_chart_config = {
            labels: [
                'Staf Tata Usaha',
                'Guru',
                'Pegawai Perpustakaan',
                'Satuan Pengamanan',
                'Pegawai Kebersihan'
            ],
            datasets: [
                {
                    label: ' Jumlah',
                    data: [
                        pegawai_distribution_chart_data.staf_tata_usaha,
                        pegawai_distribution_chart_data.guru,
                        pegawai_distribution_chart_data.pegawai_perpustakaan,
                        pegawai_distribution_chart_data.satuan_pengamanan,
                        pegawai_distribution_chart_data.pegawai_kebersihan
                    ],
                    backgroundColor: [
                        '#007bff',
                        '#28a745',
                        '#fd7e14',
                        '#6f42c1',
                        '#e63849'
                    ],
                    hoverOffset: 8
                }
            ]
        };

        pegawai_distribution_chart_instance = new Chart(
            pegawai_distribution_chart,
            {
                type: 'doughnut',
                data: pegawai_distribution_chart_config,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            }
        );
    };

    const prestasi_improvement_chart_function = async () => {
        const url_params = new URLSearchParams(window.location.search);
        const prestasi_improvement_tahun_value = url_params.get('prestasi_improvement_tahun_filter');

        const prestasi_improvement_chart_response = await fetch(`/api/prestasi-improvement?prestasi_improvement_tahun_filter=${prestasi_improvement_tahun_value}`);
        const prestasi_improvement_chart_data = await prestasi_improvement_chart_response.json();

        if (prestasi_improvement_chart_instance) {
            prestasi_improvement_chart_instance.destroy();
        }

        const prestasi_improvement_chart_config = {
            labels: [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            datasets: [
                {
                    data: prestasi_improvement_chart_data,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }
            ]
        };

        prestasi_improvement_chart_instance = new Chart(
            prestasi_improvement_chart,
            {
                type: 'line',
                data: prestasi_improvement_chart_config,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            }
        );
    };

    pegawai_distribution_chart_function();
    prestasi_improvement_chart_function();
}

if (prestasi_improvement_tahun_filter_form) {
    prestasi_improvement_tahun_select.addEventListener('change', () => {
        prestasi_improvement_tahun_filter_form.submit();
    });
}

if (semester_calendar) {
    const semester_calendar_instance = new Calendar(semester_calendar, {
        plugins: [dayGridPlugin],
        initialView: 'dayGridMonth',
        events: '/api/semester-calendar',
        buttonText: {
            today: 'Hari ini',
            month: 'Bulan',
            week: 'Minggu',
            day: 'Hari',
            list: 'Daftar'
        },
        locale: 'id',
        height: 500
    });

    semester_calendar_instance.render();
}
