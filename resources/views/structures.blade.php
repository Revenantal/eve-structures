@extends('adminlte::page')
@section('title', 'Structures')
@section('content_header')
    <h1>Structures</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Filters</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form>
                            <div class="col-sm-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><i class="fas fa-globe"></i> Universe </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ddlRegion" class="sort-by-button" data-sort-value="region">Region <i class="fas fa-sort-alpha-down"></i></label>
                                                    <select multiple id="ddlRegion" name="ddlRegion" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        @foreach ($regions as $region)
                                                            <option value=".region-{{ str_replace(' ', '-', strtolower($region->name)) }}">{{ $region->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ddlSystem" class="sort-by-button" data-sort-value="system">System <i class="fas fa-sort-alpha-down"></i></label>
                                                    <select multiple id="ddlSystem" name="ddlSystem" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        @foreach ($systems as $system)
                                                            <option value=".system-{{ str_replace(' ', '-', strtolower($system->name)) }}">{{ $system->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><i class="fas fa-flag"></i> Allegiance</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ddlCorporation" class="sort-by-button" data-sort-value="corporation">Corporation <i class="fas fa-sort-alpha-down"></i></label>
                                                    <select multiple id="ddlCorporation" name="ddlCorporation" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        @foreach ($corporations as $corporation)
                                                            <option value=".corporation-{{ str_replace(' ', '-', strtolower($corporation->name)) }}">{{ $corporation->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ddlAlliance" class="sort-by-button" data-sort-value="alliance">Alliance <i class="fas fa-sort-alpha-down"></i></label>
                                                    <select multiple id="ddlAlliance" name="ddlAlliance" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        @foreach ($alliances as $alliance)
                                                            <option value=".alliance-{{ str_replace(' ', '-', strtolower($alliance->name)) }}">{{ $alliance->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><i class="fa fa-fw fa-building"></i> Structure</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ddlGroup" class="sort-by-button" data-sort-value="group">Group <i class="fas fa-sort-alpha-down"></i></label>
                                                    <select multiple id="ddlGroup" name="ddlGroup" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        @foreach ($groups as $group)
                                                            <option value=".group-{{ str_replace(' ', '-', strtolower($group->name)) }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ddlType" class="sort-by-button" data-sort-value="type">Type <i class="fas fa-sort-alpha-down"></i></label>
                                                    <select multiple id="ddlType" name="ddlType" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        @foreach ($types as $type)
                                                            <option value=".type-{{ str_replace(' ', '-', strtolower($type->name)) }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ddlStatus" class="sort-by-button" data-sort-value="status">Status <i class="fas fa-sort-alpha-up"></i></label>
                                                    <select multiple id="ddlStatus" name="ddlStatus" class="form-control filters-select">
                                                        <option selected value="">All</option>
                                                        <option value=".status-fueled">Fueled</option>
                                                        <option value=".status-low">Low Power</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row structures">
        @foreach ($structures as $structure)
            <div class="col-lg-3 col-md-6 col-sm-12 element-item
                    region-{{ str_replace(' ', '-', strtolower($structure->system->region->name)) }}
                    system-{{ str_replace(' ', '-', strtolower($structure->system->name)) }}
                    corporation-{{ str_replace(' ', '-', strtolower($structure->corporation->name)) }}
                    alliance-{{ str_replace(' ', '-', strtolower($structure->corporation->alliance->name)) }}
                    group-{{ str_replace(' ', '-', strtolower($structure->type->group->name)) }}
                    type-{{ str_replace(' ', '-', strtolower($structure->type->name)) }}
                    @if($structure->fuel_expires) {{"status-fueled"}} @else {{"status-low"}} @endif">


                <div class="box box-widget widget-user-2 structure">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-{{ $structure->type->group->cssColor() }}">
                        <div class="widget-user-image">
                            <img class="img-rounded" src="//image.eveonline.com/Render/{{ $structure->type_id }}_128.png" alt="Structure Icon">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $structure->name }}</h3>
                        <h5 class="widget-user-desc">
                            <img class="bg-gray-light img-rounded" src="//image.eveonline.com/Corporation/{{ $structure->corporation->corporation_id }}_32.png" alt="Corporation Icon" data-placement="bottom" data-toggle="tooltip" data-original-title="{{ $structure->corporation->name }}">
                            <img class="bg-gray-light img-rounded" src="//image.eveonline.com/Alliance/{{ $structure->corporation->alliance->alliance_id }}_32.png" alt="Alliance Icon" data-placement="bottom" data-toggle="tooltip" data-original-title="{{ $structure->corporation->alliance->name }}">
                        </h5>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="hidden corporation">{{ $structure->corporation->name }}</div>
                            <div class="hidden alliance">{{ $structure->corporation->alliance->name }}</div>
                            <table class="table no-margin">
                                <tbody>
                                    <tr>
                                        <td>Structure Type</td>
                                        <td class="text-right type">{{ $structure->type->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Structure Group</td>
                                        <td class="text-right group">{{ $structure->type->group->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>System</td>
                                        <td class="text-right system">{{ $structure->system->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Region</td>
                                        <td class="text-right region">{{ $structure->system->region->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td class="text-right state">{{ $structure->friendlyState() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fuel Status</td>
                                        <td class="text-right">
                                            @if ($structure->fuel_expires)
                                                <countdown class="status" date="{{ $structure->fuel_expires }}"></countdown>
                                            @else
                                                <span class="status" class="text-danger">Low Power</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Last Update</td>
                                        <td class="text-right">{{ $structure->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/structures/{{ $structure->structure_id }}" type="button" class="btn btn-block btn-default">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop

@push('css')
@push('js')
@section('js')
    <script src="https://unpkg.com/isotope-layout@2/dist/isotope.pkgd.min.js"></script>
    <script>
        $(function() {
            var $structures = $('.structures').isotope({
                getSortData: {
                    region: '.region',
                    system: '.system',
                    corporation: '.corporation',
                    alliance: '.alliance',
                    group: '.group',
                    type: '.type',
                    status: '.status',
                }
            });

            $('.sort-by-button').on( 'click', function() {
                sortAscending = false;

                // Remove active from all other buttons
                $('.sort-by-button').removeClass('active');

                // Add active back to this button
                $(this).addClass('active');

                // Determine Current sort order
                $icon = $(this).find('i');
                if ($icon.hasClass('fa-sort-alpha-down')) {
                    $icon.removeClass('fa-sort-alpha-down');
                    $icon.addClass('fa-sort-alpha-up');
                } else {
                    sortAscending = true;
                    $icon.removeClass('fa-sort-alpha-up');
                    $icon.addClass('fa-sort-alpha-down');
                }

                // Init the ordering
                $structures.isotope({
                    sortBy: $(this).attr('data-sort-value'),
                    sortAscending: sortAscending
                });
            });


            $('.filters-select').on('change', function () {
                var allFilters = [];

                // Get all currently selected filter, join multiple same select box selections with ','
                $('.filters-select').each(function(index,value){
                    if ($(this).val() != "") {
                        allFilters.push($(this).val().join(','));
                    }
                });

                // If we have a filter selected, compile, otherwise show all
                if (allFilters.length > 0) {
                    // Get the first group of selected filters as we need to compile a list (a.x a.z, b.x b.z)
                    var compiledFilter = allFilters[0].split(',');

                    for (var x = 0; x < compiledFilter.length; x++) {
                        var curFilters = "";
                        for (var i = 1; i < allFilters.length; i++) {
                            curFilters += allFilters[i];
                        }
                        compiledFilter[x] += curFilters;
                    }
                    $structures.isotope({ filter: compiledFilter.join(',') });
                } else {
                    $structures.isotope({ filter: '*' });
                }

            });
        });
    </script>
@stop
