@extends('layouts.blank')

@section('main_container')
    <!-- page content -->
    <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row tile_count">
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fas fa-address-card"></i> Saldo em Contas</span>
                <div class="count" id="balance">{{ $balance }}</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="far fa-credit-card"></i>Total de Faturas em Aberto</span>
                <div class="count" id="openedInvoce"></div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fas fa-chart-line"></i> Total em Aplicações</span>
                <div class="count">{{$investments}}</div>
                <span class="count_bottom"><i class="green"><i class="fas fa-sort-up"></i>{{$expected_investments}}</i> de Rendimento esperado</span>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fas fa-chart-line"></i> SALDO</span>
                <div class="count" id="realBalance"></div>
            </div>
        </div>
        <!-- /top tiles -->

        <!-- GRAFICOS -->
        <div class="row">
            <div class="col-md-6">
                <div class="dashboard_graph">
                    <div class="x_panel tile fixed_height_320 overflow_hidden">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fas fa-times"></i></a>
                                </li>
                            </ul>
                            <h3>
                                Despesas X Receitas
                                <small>Demonstraçao de Despesa e Receitas nos ultimos 30 dias.</small>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="chart_expense" class="flot-base"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dashboard_graph">
                    <div class="x_panel tile fixed_height_350 overflow_hidden">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fas fa-times"></i></a>
                                </li>
                            </ul>
                            <h3>
                                Disposiçao de Saldo nas carteiras
                                <small>Divisao de saldo nas carteiras.</small>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="chart_balance_account" class="flot-base"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /GRAFICOS -->
    </div>
    </div>
    <!-- /page content -->
    @include('charts.home')

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $.getJSON("api/invocecreditcard/balanceinvoce", function (data) {
           $("#openedInvoce").append(data/100);
           realBalance = parseFloat(document.getElementById('balance').textContent - (data/100));
           $("#realBalance").append(realBalance.toFixed(2));
        });
    });
</script>
@endpush