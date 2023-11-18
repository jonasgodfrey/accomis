@extends('layouts.app')

@section('content')
<style>
    .small-12{

    }
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="px-5 breakout breakout--plain" style="min-width: 100%">
                    <div class="grid-x grid-margin-x grid-margin-y align-stretch align-center" >
                        <h3 class="h6 heavy-title cell small-12">Key Results:</h3>
                        <div class="row">
                            <div class="form-group">
                                <span class="control-label">Select:</span>
                                <select class="form-control" data-breakout-filter="true">
                                    <option value="GlobalFund" selected="selected">Global Fund portfolio</option>
                                    <option value="-" disabled="disabled">-</option>
                                    <option value="Central Africa">Central Africa</option>
                                    <option value="Eastern Europe and Central Asia">Eastern Europe and Central Asia</option>
                                    <option value="High Impact Africa 1">High Impact Africa 1</option>
                                    <option value="High Impact Africa 2">High Impact Africa 2</option>
                                    <option value="High Impact Asia">High Impact Asia</option>
                                    <option value="Latin America and Caribbean">Latin America and Caribbean</option>
                                    <option value="Middle East and North Africa">Middle East and North Africa</option>
                                    <option value="South East Asia">South East Asia</option>
                                    <option value="Southern and Eastern Africa">Southern and Eastern Africa</option>
                                    <option value="Western Africa">Western Africa</option>
                                    <option value="-" disabled="disabled">-</option>
                                    <option value="AFG">Afghanistan</option>
                                    <option value="ALB">Albania</option>
                                    <option value="DZA">Algeria</option>
                                    <option value="AGO">Angola</option>
                                    <option value="ARM">Armenia</option>
                                    <option value="AZE">Azerbaijan</option>
                                    <option value="BGD">Bangladesh</option>
                                    <option value="BLR">Belarus</option>
                                    <option value="BLZ">Belize</option>
                                    <option value="BEN">Benin</option>
                                    <option value="BTN">Bhutan</option>
                                    <option value="BOL">Bolivia (Plurinational State)</option>
                                    <option value="BWA">Botswana</option>
                                    <option value="BFA">Burkina Faso</option>
                                    <option value="BDI">Burundi</option>
                                    <option value="CIV">Côte d'Ivoire</option>
                                    <option value="KHM">Cambodia</option>
                                    <option value="CMR">Cameroon</option>
                                    <option value="CPV">Cabo Verde</option>
                                    <option value="CAF">Central African Republic</option>
                                    <option value="TCD">Chad</option>
                                    <option value="COL">Colombia</option>
                                    <option value="COM">Comoros</option>
                                    <option value="COD">Congo (Democratic Republic)</option>
                                    <option value="COG">Congo</option>
                                    <option value="CRI">Costa Rica</option>
                                    <option value="CUB">Cuba</option>
                                    <option value="DJI">Djibouti</option>
                                    <option value="DMA">Dominica</option>
                                    <option value="DOM">Dominican Republic</option>
                                    <option value="ECU">Ecuador</option>
                                    <option value="EGY">Egypt</option>
                                    <option value="SLV">El Salvador</option>
                                    <option value="ERI">Eritrea</option>
                                    <option value="SWZ">Eswatini</option>
                                    <option value="ETH">Ethiopia</option>
                                    <option value="GAB">Gabon</option>
                                    <option value="GMB">Gambia</option>
                                    <option value="GEO">Georgia</option>
                                    <option value="GHA">Ghana</option>
                                    <option value="GRD">Grenada</option>
                                    <option value="GTM">Guatemala</option>
                                    <option value="GIN">Guinea</option>
                                    <option value="GNB">Guinea-Bissau</option>
                                    <option value="GUY">Guyana</option>
                                    <option value="HTI">Haiti</option>
                                    <option value="HND">Honduras</option>
                                    <option value="IND">India</option>
                                    <option value="IDN">Indonesia</option>
                                    <option value="IRN">Iran (Islamic Republic)</option>
                                    <option value="IRQ">Iraq</option>
                                    <option value="JAM">Jamaica</option>
                                    <option value="JOR">Jordan</option>
                                    <option value="KAZ">Kazakhstan</option>
                                    <option value="KEN">Kenya</option>
                                    <option value="KIR">Kiribati</option>
                                    <option value="PRK">Korea (Democratic Peoples Republic)</option>
                                    <option value="KGZ">Kyrgyzstan</option>
                                    <option value="LAO">Lao (Peoples Democratic Republic)</option>
                                    <option value="LBN">Lebanon</option>
                                    <option value="LSO">Lesotho</option>
                                    <option value="LBR">Liberia</option>
                                    <option value="MDG">Madagascar</option>
                                    <option value="MWI">Malawi</option>
                                    <option value="MYS">Malaysia</option>
                                    <option value="MLI">Mali</option>
                                    <option value="MHL">Marshall Islands</option>
                                    <option value="MRT">Mauritania</option>
                                    <option value="MUS">Mauritius</option>
                                    <option value="FSM">Micronesia (Federated States)</option>
                                    <option value="MDA">Moldova</option>
                                    <option value="MNG">Mongolia</option>
                                    <option value="MNE">Montenegro</option>
                                    <option value="MAR">Morocco</option>
                                    <option value="MOZ">Mozambique</option>
                                    <option value="MMR">Myanmar</option>
                                    <option value="NAM">Namibia</option>
                                    <option value="NPL">Nepal</option>
                                    <option value="NIC">Nicaragua</option>
                                    <option value="NER">Niger</option>
                                    <option value="NGA">Nigeria</option>
                                    <option value="PAK">Pakistan</option>
                                    <option value="PLW">Palau</option>
                                    <option value="PSE">Palestine</option>
                                    <option value="PAN">Panama</option>
                                    <option value="PNG">Papua New Guinea</option>
                                    <option value="PRY">Paraguay</option>
                                    <option value="PER">Peru</option>
                                    <option value="PHL">Philippines</option>
                                    <option value="ROU">Romania</option>
                                    <option value="RWA">Rwanda</option>
                                    <option value="LCA">Saint Lucia</option>
                                    <option value="VCT">Saint Vincent and Grenadines</option>
                                    <option value="WSM">Samoa</option>
                                    <option value="STP">Sao Tome and Principe</option>
                                    <option value="SEN">Senegal</option>
                                    <option value="SRB">Serbia</option>
                                    <option value="SLE">Sierra Leone</option>
                                    <option value="SLB">Solomon Islands</option>
                                    <option value="SOM">Somalia</option>
                                    <option value="ZAF">South Africa</option>
                                    <option value="SSD">South Sudan</option>
                                    <option value="LKA">Sri Lanka</option>
                                    <option value="SDN">Sudan</option>
                                    <option value="SUR">Suriname</option>
                                    <option value="SYR">Syrian Arab Republic</option>
                                    <option value="TJK">Tajikistan</option>
                                    <option value="TZA">Tanzania (United Republic)</option>
                                    <option value="THA">Thailand</option>
                                    <option value="TLS">Timor-Leste</option>
                                    <option value="TGO">Togo</option>
                                    <option value="TON">Tonga</option>
                                    <option value="TUN">Tunisia</option>
                                    <option value="TKM">Turkmenistan</option>
                                    <option value="TUV">Tuvalu</option>
                                    <option value="UGA">Uganda</option>
                                    <option value="UKR">Ukraine</option>
                                    <option value="UZB">Uzbekistan</option>
                                    <option value="VUT">Vanuatu</option>
                                    <option value="VEN">Venezuela</option>
                                    <option value="VNM">Viet Nam</option>
                                    <option value="YEM">Yemen</option>
                                    <option value="ZMB">Zambia</option>
                                    <option value="QNB">Zanzibar</option>
                                    <option value="ZWE">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="chart-wrap grid-y align-justify" style="min-width: 100%">
                                <div data-chart="key-results-chart" data-data="/media/12215/key_results.json"
                                    data-filter="GlobalFund"
                                    data-missingkeys="{&quot;null&quot;:&quot;No data&quot;,&quot;na&quot;:&quot;Not applicable&quot;}"
                                    data-results="[{&quot;key&quot;:&quot;People on antiretroviral therapy for HIV&quot;,&quot;text&quot;:&quot;People on antiretroviral therapy for HIV&quot;},{&quot;key&quot;:&quot;People treated for TB&quot;,&quot;text&quot;:&quot;People treated for TB&quot;},{&quot;key&quot;:&quot;Mosquito nets distributed&quot;,&quot;text&quot;:&quot;Mosquito nets distributed&quot;}]"
                                    data-in-view="true">
                                    <div class="grid-x grid-margin-x grid-margin-y row justify-content-center"> --}}
                                        <div class=" col-xl-4 col-md-4 col-sm-12 key-result key_results--hiv cell small-12 medium-4 large-4"
                                            data-result="People on antiretroviral therapy for HIV">
                                            <div class="key-result__icon"><img width="38"
                                                    src="https://www.theglobalfund.org/_Site/Images/icons/AIDS_red.svg">
                                            </div>
                                            <div class="key-result__num h3 heavy-title">24.5m</div>
                                            <div class="key-result__text"><strong>People on antiretroviral therapy for
                                                    HIV</strong>
                                            </div>
                                        </div>
                                        <div class=" col-xl-4 col-md-4 col-sm-12 key-result key_results--tb cell small-12 medium-4 large-4"
                                            data-result="People treated for TB">
                                            <div class="key-result__icon"><img width="38"
                                                    src="https://www.theglobalfund.org/_Site/Images/icons/TB_blue.svg">
                                            </div>
                                            <div class="key-result__num h3 heavy-title">6.7m</div>
                                            <div class="key-result__text"><strong>People treated for TB</strong></div>
                                        </div>
                                        <div class=" col-xl-4 col-md-4 col-sm-12 key-result key_results--malaria cell small-12 medium-4 large-4"
                                            data-result="Mosquito nets distributed">
                                            <div class="key-result__icon"><img width="38"
                                                    src="https://www.theglobalfund.org/_Site/Images/icons/Malaria_yellow.svg">
                                            </div>
                                            <div class="key-result__num h3 heavy-title">219.7m</div>
                                            <div class="key-result__text"><strong>Mosquito nets distributed</strong></div>
                                        </div>
                                    {{-- </div>
                                </div>
                            </div> --}}
                        </div>
                        <small class="cell small-12 breakout__source">Programmatic results achieved during 2022 by
                            countries and
                            regions where the Global Fund invests. Progress graphs are based on latest published data from
                            WHO (2022
                            release for TB and malaria) and UNAIDS (2023 release). Malaria mosquito net coverage calculated
                            based on 38
                            African countries for which data is available from WHO/Malaria Atlas Project estimates. <a
                                href="#related-resources">Global Fund Regional Groupings</a>.</small>
                    </div>
                </div>
            </div>
            <div class="container">
                {!! $chart->container() !!}
            </div>
        </section>
    </div>
    {!! $chart->script() !!}
@endsection
