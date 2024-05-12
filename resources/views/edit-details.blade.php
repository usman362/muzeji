@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="back-button">
            <a href="{{ route('poi.index', $poi->exhibition->id) }}"><button><i class="fa fa-chevron-left"></i></button></a>
        </div>

        <form action="{{ route('poi.update', $poi->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="project-details">
                <div class="main-title">
                    <b><input type="text" class="form-control mb-2" name="main_title" value="{{ $poi->title }}"></b>
                    <span>Main Title</span>
                </div>

                <div class="flags-section">
                    @foreach ($poi->details as $key => $detail)
                        <div class="tablinks active" id="defaultOpen" onclick="changeTab(event, '{{ $detail->language }}')">
                            <img src="https://hatscripts.github.io/circle-flags/flags/{{ $detail->flag }}.svg"
                                alt="" width="36" />
                        </div>
                    @endforeach
                    <div>
                        <button type="button" class="add-lang-btn"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div id="main-lang-div">
                    @foreach ($poi->details as $key => $detail)
                        <div id="{{ $detail->language }}" class="tab-content">
                            <input type="hidden" name="main_id[]" value="{{ $detail->id }}">
                            <div class="title-1"><input type="text" class="form-control" value="{{ $detail->title }}"
                                    name="title[]">
                            </div>
                            <div class="paragraph">
                                <textarea name="description[]" id="" class="form-control" rows="10">{{ $detail->description }}</textarea>
                            </div>

                            <div class="mt-2 flag-language">
                                <div class="row">
                                    <div class="col-md-6 p-1">
                                        <sub for="">Language</sub>
                                        <select name="language[]" id="language" class="form-control select2 p">
                                            <option value="en" @selected($detail->language == 'en')>English</option>
                                            <option value="ar" @selected($detail->language == 'ar')>Arabic</option>
                                            <option value="de" @selected($detail->language == 'de')>German</option>
                                            <option value="fr" @selected($detail->language == 'fr')>French</option>
                                            <option value="es" @selected($detail->language == 'es')>Spanish</option>
                                            <option value="it" @selected($detail->language == 'it')>Italian</option>
                                            <option value="nl" @selected($detail->language == 'nl')>Dutch</option>
                                            <option value="ja" @selected($detail->language == 'ja')>Japanese</option>
                                            <option value="ko" @selected($detail->language == 'ko')>Korean</option>
                                            <option value="pt" @selected($detail->language == 'pt')>Portuguese</option>
                                            <option value="ru" @selected($detail->language == 'ru')>Russian</option>
                                            <option value="zh" @selected($detail->language == 'zh')>Chinese</option>
                                            <option value="hi" @selected($detail->language == 'hi')>Hindi</option>
                                            <option value="tr" @selected($detail->language == 'tr')>Turkish</option>
                                            <option value="id" @selected($detail->language == 'id')>Indonesian</option>
                                            <option value="vi" @selected($detail->language == 'vi')>Vietnamese</option>
                                            <option value="th" @selected($detail->language == 'th')>Thai</option>
                                            <option value="el" @selected($detail->language == 'el')>Greek</option>
                                            <option value="sv" @selected($detail->language == 'sv')>Swedish</option>
                                            <option value="pl" @selected($detail->language == 'pl')>Polish</option>
                                            <option value="da" @selected($detail->language == 'da')>Danish</option>
                                            <option value="fi" @selected($detail->language == 'fi')>Finnish</option>
                                            <option value="no" @selected($detail->language == 'no')>Norwegian</option>
                                            <option value="he" @selected($detail->language == 'he')>Hebrew</option>
                                            <option value="cs" @selected($detail->language == 'cs')>Czech</option>
                                            <option value="hu" @selected($detail->language == 'hu')>Hungarian</option>
                                            <option value="ro" @selected($detail->language == 'ro')>Romanian</option>
                                            <option value="sk" @selected($detail->language == 'sk')>Slovak</option>
                                            <option value="uk" @selected($detail->language == 'uk')>Ukrainian</option>
                                            <option value="bg" @selected($detail->language == 'bg')>Bulgarian</option>
                                            <option value="sr" @selected($detail->language == 'sr')>Serbian</option>
                                            <option value="hr" @selected($detail->language == 'hr')>Croatian</option>
                                            <option value="sl" @selected($detail->language == 'sl')>Slovenian</option>
                                            <option value="et" @selected($detail->language == 'et')>Estonian</option>
                                            <option value="lt" @selected($detail->language == 'lt')>Lithuanian</option>
                                            <option value="lv" @selected($detail->language == 'lv')>Latvian</option>
                                            <option value="mk" @selected($detail->language == 'mk')>Macedonian</option>
                                            <option value="sq" @selected($detail->language == 'sq')>Albanian</option>
                                            <option value="hy" @selected($detail->language == 'hy')>Armenian</option>
                                            <option value="az" @selected($detail->language == 'az')>Azerbaijani</option>
                                            <option value="eu" @selected($detail->language == 'eu')>Basque</option>
                                            <option value="be" @selected($detail->language == 'be')>Belarusian</option>
                                            <option value="bs" @selected($detail->language == 'bs')>Bosnian</option>
                                            <option value="ka" @selected($detail->language == 'ka')>Georgian</option>
                                            <option value="is" @selected($detail->language == 'is')>Icelandic</option>
                                            <option value="gl" @selected($detail->language == 'gl')>Galician</option>
                                            <option value="mt" @selected($detail->language == 'mt')>Maltese</option>
                                            <option value="et" @selected($detail->language == 'et')>Estonian</option>
                                            <option value="lb" @selected($detail->language == 'lb')>Luxembourgish</option>
                                            <option value="mk" @selected($detail->language == 'mk')>Macedonian</option>
                                            <option value="mn" @selected($detail->language == 'mn')>Mongolian</option>
                                            <option value="ne" @selected($detail->language == 'ne')>Nepali</option>
                                            <option value="ps" @selected($detail->language == 'ps')>Pashto</option>
                                            <option value="fa" @selected($detail->language == 'fa')>Persian</option>
                                            <option value="rw" @selected($detail->language == 'rw')>Kinyarwanda</option>
                                            <option value="si" @selected($detail->language == 'si')>Sinhala</option>
                                            <option value="so" @selected($detail->language == 'so')>Somali</option>
                                            <option value="ta" @selected($detail->language == 'ta')>Tamil</option>
                                            <option value="te" @selected($detail->language == 'te')>Telugu</option>
                                            <option value="ur" @selected($detail->language == 'ur')>Urdu</option>
                                            <option value="yo" @selected($detail->language == 'yo')>Yoruba</option>
                                            <option value="zu" @selected($detail->language == 'zu')>Zulu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 p-1">
                                        <sub for="">Country</sub>
                                        <select name="flag[]" id="flag" class="form-control select2">
                                            <option @selected($detail->flag == 'ad') value="ad">Andorra</option>
                                            <option @selected($detail->flag == 'ae') value="ae">United Arab Emirates
                                            </option>
                                            <option @selected($detail->flag == 'af') value="af">Afghanistan</option>
                                            <option @selected($detail->flag == 'ag') value="ag">Antigua and Barbuda
                                            </option>
                                            <option @selected($detail->flag == 'ai') value="ai">Anguilla</option>
                                            <option @selected($detail->flag == 'al') value="al">Albania</option>
                                            <option @selected($detail->flag == 'am') value="am">Armenia</option>
                                            <option @selected($detail->flag == 'an') value="an">Netherlands Antilles
                                            </option>
                                            <option @selected($detail->flag == 'ao') value="ao">Angola</option>
                                            <option @selected($detail->flag == 'aq') value="aq">Antarctica</option>
                                            <option @selected($detail->flag == 'ar') value="ar">Argentina</option>
                                            <option @selected($detail->flag == 'as') value="as">American Samoa</option>
                                            <option @selected($detail->flag == 'at') value="at">Austria</option>
                                            <option @selected($detail->flag == 'au') value="au">Australia</option>
                                            <option @selected($detail->flag == 'au-aboriginal') value="au-aboriginal">Australian
                                                Aboriginal</option>
                                            <option @selected($detail->flag == 'au-torres_strait_islands') value="au-torres_strait_islands">Torres
                                                Strait Islands</option>
                                            <option @selected($detail->flag == 'au-act') value="au-act">Australian Capital
                                                Territory</option>
                                            <option @selected($detail->flag == 'au-nsw') value="au-nsw">New South Wales</option>
                                            <option @selected($detail->flag == 'au-nt') value="au-nt">Northern Territory
                                            </option>
                                            <option @selected($detail->flag == 'au-qld') value="au-qld">Queensland</option>
                                            <option @selected($detail->flag == 'au-sa') value="au-sa">South Australia</option>
                                            <option @selected($detail->flag == 'au-tas') value="au-tas">Tasmania</option>
                                            <option @selected($detail->flag == 'au-vic') value="au-vic">Victoria</option>
                                            <option @selected($detail->flag == 'au-wa') value="au-wa">Western Australia</option>
                                            <option @selected($detail->flag == 'aw') value="aw">Aruba</option>
                                            <option @selected($detail->flag == 'ax') value="ax">Åland Islands</option>
                                            <option @selected($detail->flag == 'az') value="az">Azerbaijan</option>
                                            <option @selected($detail->flag == 'ba') value="ba">Bosnia and Herzegovina
                                            </option>
                                            <option @selected($detail->flag == 'bb') value="bb">Barbados</option>
                                            <option @selected($detail->flag == 'bd') value="bd">Bangladesh</option>
                                            <option @selected($detail->flag == 'be') value="be">Belgium</option>
                                            <option @selected($detail->flag == 'bf') value="bf">Burkina Faso</option>
                                            <option @selected($detail->flag == 'bg') value="bg">Bulgaria</option>
                                            <option @selected($detail->flag == 'bh') value="bh">Bahrain</option>
                                            <option @selected($detail->flag == 'bi') value="bi">Burundi</option>
                                            <option @selected($detail->flag == 'bj') value="bj">Benin</option>
                                            <option @selected($detail->flag == 'bl') value="bl">Saint Barthélemy</option>
                                            <option @selected($detail->flag == 'bm') value="bm">Bermuda</option>
                                            <option @selected($detail->flag == 'bn') value="bn">Brunei</option>
                                            <option @selected($detail->flag == 'bo') value="bo">Bolivia</option>
                                            <option @selected($detail->flag == 'bq-bo') value="bq-bo">Bonaire</option>
                                            <option @selected($detail->flag == 'bq-sa') value="bq-sa">Saba</option>
                                            <option @selected($detail->flag == 'bq-se') value="bq-se">Sint Eustatius</option>
                                            <option @selected($detail->flag == 'br') value="br">Brazil</option>
                                            <option @selected($detail->flag == 'bs') value="bs">Bahamas</option>
                                            <option @selected($detail->flag == 'bt') value="bt">Bhutan</option>
                                            <option @selected($detail->flag == 'bv') value="bv">Bouvet Island</option>
                                            <option @selected($detail->flag == 'bw') value="bw">Botswana</option>
                                            <option @selected($detail->flag == 'by') value="by">Belarus</option>
                                            <option @selected($detail->flag == 'bz') value="bz">Belize</option>
                                            <option @selected($detail->flag == 'ca') value="ca">Canada</option>
                                            <option @selected($detail->flag == 'ca-bc') value="ca-bc">British Columbia</option>
                                            <option @selected($detail->flag == 'ca-qc') value="ca-qc">Quebec</option>
                                            <option @selected($detail->flag == 'cc') value="cc">Cocos</option>
                                            <option @selected($detail->flag == 'cd') value="cd">Congo, Democratic
                                                Republic of the</option>
                                            <option @selected($detail->flag == 'cf') value="cf">Central African Republic
                                            </option>
                                            <option @selected($detail->flag == 'cg') value="cg">Congo</option>
                                            <option @selected($detail->flag == 'ch') value="ch">Switzerland</option>
                                            <option @selected($detail->flag == 'ch-gr') value="ch-gr">Grisons</option>
                                            <option @selected($detail->flag == 'ci') value="ci">Ivory Coast</option>
                                            <option @selected($detail->flag == 'ck') value="ck">Cook Islands</option>
                                            <option @selected($detail->flag == 'cl') value="cl">Chile</option>
                                            <option @selected($detail->flag == 'cm') value="cm">Cameroon</option>
                                            <option @selected($detail->flag == 'cn') value="cn">China</option>
                                            <option @selected($detail->flag == 'cn-xj') value="cn-xj">Xinjiang</option>
                                            <option @selected($detail->flag == 'co') value="co">Colombia</option>
                                            <option @selected($detail->flag == 'cq') value="cq">Sark</option>
                                            <option @selected($detail->flag == 'cr') value="cr">Costa Rica</option>
                                            <option @selected($detail->flag == 'cu') value="cu">Cuba</option>
                                            <option @selected($detail->flag == 'cv') value="cv">Cabo Verde</option>
                                            <option @selected($detail->flag == 'cw') value="cw">Curaçao</option>
                                            <option @selected($detail->flag == 'cx') value="cx">Christmas Island</option>
                                            <option @selected($detail->flag == 'cy') value="cy">Cyprus</option>
                                            <option @selected($detail->flag == 'cz') value="cz">Czechia</option>
                                            <option @selected($detail->flag == 'de') value="de">Germany</option>
                                            <option @selected($detail->flag == 'dj') value="dj">Djibouti</option>
                                            <option @selected($detail->flag == 'dk') value="dk">Denmark</option>
                                            <option @selected($detail->flag == 'dm') value="dm">Dominica</option>
                                            <option @selected($detail->flag == 'do') value="do">Dominican Republic
                                            </option>
                                            <option @selected($detail->flag == 'dz') value="dz">Algeria</option>
                                            <option @selected($detail->flag == 'east_african_federation') value="east_african_federation">East
                                                African Federation</option>
                                            <option @selected($detail->flag == 'easter_island') value="easter_island">Easter Island
                                            </option>
                                            <option @selected($detail->flag == 'ec') value="ec">Ecuador</option>
                                            <option @selected($detail->flag == 'ec-w') value="ec-w">Galápagos</option>
                                            <option @selected($detail->flag == 'ee') value="ee">Estonia</option>
                                            <option @selected($detail->flag == 'eg') value="eg">Egypt</option>
                                            <option @selected($detail->flag == 'eh') value="eh">Western Sahara</option>
                                            <option @selected($detail->flag == 'er') value="er">Eritrea</option>
                                            <option @selected($detail->flag == 'es') value="es">Spain</option>
                                            <option @selected($detail->flag == 'ad') value="ad">Andorra</option>
                                            <option @selected($detail->flag == 'ae') value="ae">United Arab Emirates
                                            </option>
                                            <option @selected($detail->flag == 'af') value="af">Afghanistan</option>
                                            <option @selected($detail->flag == 'ag') value="ag">Antigua and Barbuda
                                            </option>
                                            <option @selected($detail->flag == 'ai') value="ai">Anguilla</option>
                                            <option @selected($detail->flag == 'al') value="al">Albania</option>
                                            <option @selected($detail->flag == 'am') value="am">Armenia</option>
                                            <option @selected($detail->flag == 'an') value="an">Netherlands Antilles
                                            </option>
                                            <option @selected($detail->flag == 'ao') value="ao">Angola</option>
                                            <option @selected($detail->flag == 'aq') value="aq">Antarctica</option>
                                            <option @selected($detail->flag == 'ar') value="ar">Argentina</option>
                                            <option @selected($detail->flag == 'as') value="as">American Samoa</option>
                                            <option @selected($detail->flag == 'at') value="at">Austria</option>
                                            <option @selected($detail->flag == 'au') value="au">Australia</option>
                                            <option @selected($detail->flag == 'au-aboriginal') value="au-aboriginal">Australian
                                                Aboriginal</option>
                                            <option @selected($detail->flag == 'au-torres_strait_islands') value="au-torres_strait_islands">Torres
                                                Strait Islands</option>
                                            <option @selected($detail->flag == 'au-act') value="au-act">Australian Capital
                                                Territory</option>
                                            <option @selected($detail->flag == 'au-nsw') value="au-nsw">New South Wales</option>
                                            <option @selected($detail->flag == 'au-nt') value="au-nt">Northern Territory
                                            </option>
                                            <option @selected($detail->flag == 'au-qld') value="au-qld">Queensland</option>
                                            <option @selected($detail->flag == 'au-sa') value="au-sa">South Australia</option>
                                            <option @selected($detail->flag == 'au-tas') value="au-tas">Tasmania</option>
                                            <option @selected($detail->flag == 'au-vic') value="au-vic">Victoria</option>
                                            <option @selected($detail->flag == 'au-wa') value="au-wa">Western Australia
                                            </option>
                                            <option @selected($detail->flag == 'aw') value="aw">Aruba</option>
                                            <option @selected($detail->flag == 'ax') value="ax">Åland Islands</option>
                                            <option @selected($detail->flag == 'az') value="az">Azerbaijan</option>
                                            <option @selected($detail->flag == 'ba') value="ba">Bosnia and Herzegovina
                                            </option>
                                            <option @selected($detail->flag == 'bb') value="bb">Barbados</option>
                                            <option @selected($detail->flag == 'bd') value="bd">Bangladesh</option>
                                            <option @selected($detail->flag == 'be') value="be">Belgium</option>
                                            <option @selected($detail->flag == 'bf') value="bf">Burkina Faso</option>
                                            <option @selected($detail->flag == 'bg') value="bg">Bulgaria</option>
                                            <option @selected($detail->flag == 'bh') value="bh">Bahrain</option>
                                            <option @selected($detail->flag == 'bi') value="bi">Burundi</option>
                                            <option @selected($detail->flag == 'bj') value="bj">Benin</option>
                                            <option @selected($detail->flag == 'bl') value="bl">Saint Barthélemy</option>
                                            <option @selected($detail->flag == 'bm') value="bm">Bermuda</option>
                                            <option @selected($detail->flag == 'bn') value="bn">Brunei</option>
                                            <option @selected($detail->flag == 'bo') value="bo">Bolivia</option>
                                            <option @selected($detail->flag == 'bq-bo') value="bq-bo">Bonaire</option>
                                            <option @selected($detail->flag == 'bq-sa') value="bq-sa">Saba</option>
                                            <option @selected($detail->flag == 'bq-se') value="bq-se">Sint Eustatius</option>
                                            <option @selected($detail->flag == 'br') value="br">Brazil</option>
                                            <option @selected($detail->flag == 'bs') value="bs">Bahamas</option>
                                            <option @selected($detail->flag == 'bt') value="bt">Bhutan</option>
                                            <option @selected($detail->flag == 'bv') value="bv">Bouvet Island</option>
                                            <option @selected($detail->flag == 'bw') value="bw">Botswana</option>
                                            <option @selected($detail->flag == 'by') value="by">Belarus</option>
                                            <option @selected($detail->flag == 'bz') value="bz">Belize</option>
                                            <option @selected($detail->flag == 'ca') value="ca">Canada</option>
                                            <option @selected($detail->flag == 'ca-bc') value="ca-bc">British Columbia</option>
                                            <option @selected($detail->flag == 'ca-qc') value="ca-qc">Quebec</option>
                                            <option @selected($detail->flag == 'cc') value="cc">Cocos (Keeling) Islands
                                            </option>
                                            <option @selected($detail->flag == 'cd') value="cd">Congo, Democratic
                                                Republic of the</option>
                                            <option @selected($detail->flag == 'cf') value="cf">Central African Republic
                                            </option>
                                            <option @selected($detail->flag == 'cg') value="cg">Congo</option>
                                            <option @selected($detail->flag == 'ch') value="ch">Switzerland</option>
                                            <option @selected($detail->flag == 'ch-gr') value="ch-gr">Grisons</option>
                                            <option @selected($detail->flag == 'ci') value="ci">Ivory Coast</option>
                                            <option @selected($detail->flag == 'ck') value="ck">Cook Islands</option>
                                            <option @selected($detail->flag == 'cl') value="cl">Chile</option>
                                            <option @selected($detail->flag == 'cm') value="cm">Cameroon</option>
                                            <option @selected($detail->flag == 'cn') value="cn">China</option>
                                            <option @selected($detail->flag == 'cn-xj') value="cn-xj">Xinjiang</option>
                                            <option @selected($detail->flag == 'co') value="co">Colombia</option>
                                            <option @selected($detail->flag == 'cq') value="cq">Sark</option>
                                            <option @selected($detail->flag == 'cr') value="cr">Costa Rica</option>
                                            <option @selected($detail->flag == 'cu') value="cu">Cuba</option>
                                            <option @selected($detail->flag == 'cv') value="cv">Cabo Verde</option>
                                            <option @selected($detail->flag == 'cw') value="cw">Curaçao</option>
                                            <option @selected($detail->flag == 'cx') value="cx">Christmas Island</option>
                                            <option @selected($detail->flag == 'cy') value="cy">Cyprus</option>
                                            <option @selected($detail->flag == 'cz') value="cz">Czechia</option>
                                            <option @selected($detail->flag == 'de') value="de">Germany</option>
                                            <option @selected($detail->flag == 'dj') value="dj">Djibouti</option>
                                            <option @selected($detail->flag == 'dk') value="dk">Denmark</option>
                                            <option @selected($detail->flag == 'dm') value="dm">Dominica</option>
                                            <option @selected($detail->flag == 'do') value="do">Dominican Republic
                                            </option>
                                            <option @selected($detail->flag == 'dz') value="dz">Algeria</option>
                                            <option @selected($detail->flag == 'earth') value="earth">Earth</option>
                                            <option @selected($detail->flag == 'east_african_federation') value="east_african_federation">East
                                                African Federation</option>
                                            <option @selected($detail->flag == 'easter_island') value="easter_island">Easter Island
                                            </option>
                                            <option @selected($detail->flag == 'ec') value="ec">Ecuador</option>
                                            <option @selected($detail->flag == 'ec-w') value="ec-w">Galápagos</option>
                                            <option @selected($detail->flag == 'ee') value="ee">Estonia</option>
                                            <option @selected($detail->flag == 'eg') value="eg">Egypt</option>
                                            <option @selected($detail->flag == 'eh') value="eh">Western Sahara</option>
                                            <option @selected($detail->flag == 'er') value="er">Eritrea</option>
                                            <option @selected($detail->flag == 'es') value="es">Spain</option>
                                            <option @selected($detail->flag == 'es-ar') value="es-ar">Aragon</option>
                                            <option @selected($detail->flag == 'es-ce') value="es-ce">Ceuta</option>
                                            <option @selected($detail->flag == 'es-cn') value="es-cn">Canary Islands</option>
                                            <option @selected($detail->flag == 'es-ct') value="es-ct">Catalonia</option>
                                            <option @selected($detail->flag == 'es-ga') value="es-ga">Galicia</option>
                                            <option @selected($detail->flag == 'es-ib') value="es-ib">Balearic Islands</option>
                                            <option @selected($detail->flag == 'es-ml') value="es-ml">Melilla</option>
                                            <option @selected($detail->flag == 'es-pv') value="es-pv">Basque Country</option>
                                            <option @selected($detail->flag == 'et') value="et">Ethiopia</option>
                                            <option @selected($detail->flag == 'et-af') value="et-af">Afar</option>
                                            <option @selected($detail->flag == 'et-am') value="et-am">Amhara</option>
                                            <option @selected($detail->flag == 'et-be') value="et-be">Benishangul-Gumuz
                                            </option>
                                            <option @selected($detail->flag == 'et-ga') value="et-ga">Gambela</option>
                                            <option @selected($detail->flag == 'et-ha') value="et-ha">Harari</option>
                                            <option @selected($detail->flag == 'et-or') value="et-or">Oromia</option>
                                            <option @selected($detail->flag == 'et-si') value="et-si">Sidama</option>
                                            <option @selected($detail->flag == 'et-sn') value="et-sn">Southern Nations,
                                                Nationalities, and Peoples' Region
                                            </option>
                                            <option @selected($detail->flag == 'et-so') value="et-so">Somali</option>
                                            <option @selected($detail->flag == 'et-sw') value="et-sw">South West Region
                                            </option>
                                            <option @selected($detail->flag == 'et-ti') value="et-ti">Tigray</option>
                                            <option @selected($detail->flag == 'eu') value="eu">European Union</option>
                                            <option @selected($detail->flag == 'ewe') value="ewe">Ewe</option>
                                            <option @selected($detail->flag == 'fi') value="fi">Finland</option>
                                            <option @selected($detail->flag == 'fj') value="fj">Fiji</option>
                                            <option @selected($detail->flag == 'fk') value="fk">Falkland Islands
                                                (Malvinas)
                                            </option>
                                            <option @selected($detail->flag == 'fm') value="fm">Micronesia</option>
                                            <option @selected($detail->flag == 'fo') value="fo">Faroe Islands</option>
                                            <option @selected($detail->flag == 'fr') value="fr">France</option>
                                            <option @selected($detail->flag == 'fr-20r') value="fr-20r">Corsica</option>
                                            <option @selected($detail->flag == 'fr-bre') value="fr-bre">Brittany</option>
                                            <option @selected($detail->flag == 'fr-cp') value="fr-cp">Clipperton Island
                                            </option>
                                            <option @selected($detail->flag == 'ga') value="ga">Gabon</option>
                                            <option @selected($detail->flag == 'gb') value="gb">United Kingdom</option>
                                            <option @selected($detail->flag == 'gb-con') value="gb-con">Cornwall</option>
                                            <option @selected($detail->flag == 'gb-eng') value="gb-eng">England</option>
                                            <option @selected($detail->flag == 'gb-nir') value="gb-nir">Northern Ireland</option>
                                            <option @selected($detail->flag == 'gb-ork') value="gb-ork">Orkney</option>
                                            <option @selected($detail->flag == 'gb-sct') value="gb-sct">Scotland</option>
                                            <option @selected($detail->flag == 'gb-wls') value="gb-wls">Wales</option>
                                            <option @selected($detail->flag == 'gd') value="gd">Grenada</option>
                                            <option @selected($detail->flag == 'ge') value="ge">Georgia</option>
                                            <option @selected($detail->flag == 'ge-ab') value="ge-ab">Abkhazia</option>
                                            <option @selected($detail->flag == 'gf') value="gf">French Guiana</option>
                                            <option @selected($detail->flag == 'gg') value="gg">Guernsey</option>
                                            <option @selected($detail->flag == 'gh') value="gh">Ghana</option>
                                            <option @selected($detail->flag == 'gi') value="gi">Gibraltar</option>
                                            <option @selected($detail->flag == 'gl') value="gl">Greenland</option>
                                            <option @selected($detail->flag == 'gm') value="gm">Gambia</option>
                                            <option @selected($detail->flag == 'gn') value="gn">Guinea</option>
                                            <option @selected($detail->flag == 'gp') value="gp">Guadeloupe</option>
                                            <option @selected($detail->flag == 'gq') value="gq">Equatorial Guinea
                                            </option>
                                            <option @selected($detail->flag == 'gr') value="gr">Greece</option>
                                            <option @selected($detail->flag == 'gs') value="gs">South Georgia and the
                                                South Sandwich Islands</option>
                                            <option @selected($detail->flag == 'gt') value="gt">Guatemala</option>
                                            <option @selected($detail->flag == 'gu') value="gu">Guam</option>
                                            <option @selected($detail->flag == 'guarani') value="guarani">Guarani</option>
                                            <option @selected($detail->flag == 'gw') value="gw">Guinea-Bissau</option>
                                            <option @selected($detail->flag == 'gy') value="gy">Guyana</option>
                                            <option @selected($detail->flag == 'hausa') value="hausa">Hausa</option>
                                            <option @selected($detail->flag == 'hk') value="hk">Hong Kong</option>
                                            <option @selected($detail->flag == 'hm') value="hm">Heard Island and McDonald
                                                Islands</option>
                                            <option @selected($detail->flag == 'hn') value="hn">Honduras</option>
                                            <option @selected($detail->flag == 'hr') value="hr">Croatia</option>
                                            <option @selected($detail->flag == 'ht') value="ht">Haiti</option>
                                            <option @selected($detail->flag == 'hu') value="hu">Hungary</option>
                                            <option @selected($detail->flag == 'id') value="id">Indonesia</option>
                                            <option @selected($detail->flag == 'id-jb') value="id-jb">West Java</option>
                                            <option @selected($detail->flag == 'id-jt') value="id-jt">Central Java</option>
                                            <option @selected($detail->flag == 'ie') value="ie">Ireland</option>
                                            <option @selected($detail->flag == 'il') value="il">Israel</option>
                                            <option @selected($detail->flag == 'im') value="im">Isle of Man</option>
                                            <option @selected($detail->flag == 'in') value="in">India</option>
                                            <option @selected($detail->flag == 'in-as') value="in-as">Assam</option>
                                            <option @selected($detail->flag == 'in-gj') value="in-gj">Gujarat</option>
                                            <option @selected($detail->flag == 'in-ka') value="in-ka">Karnataka</option>
                                            <option @selected($detail->flag == 'in-mn') value="in-mn">Manipur</option>
                                            <option @selected($detail->flag == 'in-mz') value="in-mz">Mizoram</option>
                                            <option @selected($detail->flag == 'in-or') value="in-or">Odisha</option>
                                            <option @selected($detail->flag == 'in-tg') value="in-tg">Telangana</option>
                                            <option @selected($detail->flag == 'in-tn') value="in-tn">Tamil Nadu</option>
                                            <option @selected($detail->flag == 'io') value="io">British Indian Ocean
                                                Territory</option>
                                            <option @selected($detail->flag == 'iq') value="iq">Iraq</option>
                                            <option @selected($detail->flag == 'iq-kr') value="iq-kr">Kurdistan</option>
                                            <option @selected($detail->flag == 'ir') value="ir">Iran</option>
                                            <option @selected($detail->flag == 'is') value="is">Iceland</option>
                                            <option @selected($detail->flag == 'it') value="it">Italy</option>
                                            <option @selected($detail->flag == 'it-21') value="it-21">Piedmont</option>
                                            <option @selected($detail->flag == 'it-23') value="it-23">Aosta Valley</option>
                                            <option @selected($detail->flag == 'it-25') value="it-25">Lombardy</option>
                                            <option @selected($detail->flag == 'it-32') value="it-32">Trentino-Alto Adige
                                            </option>
                                            <option @selected($detail->flag == 'it-34') value="it-34">Veneto</option>
                                            <option @selected($detail->flag == 'it-36') value="it-36">Friuli Venezia Giulia
                                            </option>
                                            <option @selected($detail->flag == 'it-42') value="it-42">Liguria</option>
                                            <option @selected($detail->flag == 'it-45') value="it-45">Emilia-Romagna</option>
                                            <option @selected($detail->flag == 'it-52') value="it-52">Tuscany</option>
                                            <option @selected($detail->flag == 'it-55') value="it-55">Umbria</option>
                                            <option @selected($detail->flag == 'it-57') value="it-57">Marche</option>
                                            <option @selected($detail->flag == 'it-62') value="it-62">Lazio</option>
                                            <option @selected($detail->flag == 'it-65') value="it-65">Abruzzo</option>
                                            <option @selected($detail->flag == 'it-67') value="it-67">Molise</option>
                                            <option @selected($detail->flag == 'it-72') value="it-72">Campania</option>
                                            <option @selected($detail->flag == 'it-75') value="it-75">Apulia</option>
                                            <option @selected($detail->flag == 'it-77') value="it-77">Basilicata</option>
                                            <option @selected($detail->flag == 'it-78') value="it-78">Calabria</option>
                                            <option @selected($detail->flag == 'it-82') value="it-82">Sicily</option>
                                            <option @selected($detail->flag == 'it-88') value="it-88">Sardinia</option>
                                            <option @selected($detail->flag == 'je') value="je">Jersey</option>
                                            <option @selected($detail->flag == 'jm') value="jm">Jamaica</option>
                                            <option @selected($detail->flag == 'jo') value="jo">Jordan</option>
                                            <option @selected($detail->flag == 'jp') value="jp">Japan</option>
                                            <option @selected($detail->flag == 'ke') value="ke">Kenya</option>
                                            <option @selected($detail->flag == 'kg') value="kg">Kyrgyzstan</option>
                                            <option @selected($detail->flag == 'kh') value="kh">Cambodia</option>
                                            <option @selected($detail->flag == 'ki') value="ki">Kiribati</option>
                                            <option @selected($detail->flag == 'km') value="km">Comoros</option>
                                            <option @selected($detail->flag == 'kn') value="kn">Saint Kitts and Nevis
                                            </option>
                                            <option @selected($detail->flag == 'kp') value="kp">North Korea</option>
                                            <option @selected($detail->flag == 'kr') value="kr">South Korea</option>
                                            <option @selected($detail->flag == 'kw') value="kw">Kuwait</option>
                                            <option @selected($detail->flag == 'ky') value="ky">Cayman Islands</option>
                                            <option @selected($detail->flag == 'kz') value="kz">Kazakhstan</option>
                                            <option @selected($detail->flag == 'la') value="la">Laos</option>
                                            <option @selected($detail->flag == 'lb') value="lb">Lebanon</option>
                                            <option @selected($detail->flag == 'lc') value="lc">Saint Lucia</option>
                                            <option @selected($detail->flag == 'li') value="li">Liechtenstein</option>
                                            <option @selected($detail->flag == 'lk') value="lk">Sri Lanka</option>
                                            <option @selected($detail->flag == 'lr') value="lr">Liberia</option>
                                            <option @selected($detail->flag == 'ls') value="ls">Lesotho</option>
                                            <option @selected($detail->flag == 'lt') value="lt">Lithuania</option>
                                            <option @selected($detail->flag == 'lu') value="lu">Luxembourg</option>
                                            <option @selected($detail->flag == 'lv') value="lv">Latvia</option>
                                            <option @selected($detail->flag == 'ly') value="ly">Libya</option>
                                            <option @selected($detail->flag == 'ma') value="ma">Morocco</option>
                                            <option @selected($detail->flag == 'mc') value="mc">Monaco</option>
                                            <option @selected($detail->flag == 'md') value="md">Moldova</option>
                                            <option @selected($detail->flag == 'me') value="me">Montenegro</option>
                                            <option @selected($detail->flag == 'mf') value="mf">Saint-Martin</option>
                                            <option @selected($detail->flag == 'mg') value="mg">Madagascar</option>
                                            <option @selected($detail->flag == 'mh') value="mh">Marshall Islands</option>
                                            <option @selected($detail->flag == 'mk') value="mk">North Macedonia</option>
                                            <option @selected($detail->flag == 'ml') value="ml">Mali</option>
                                            <option @selected($detail->flag == 'mm') value="mm">Myanmar</option>
                                            <option @selected($detail->flag == 'mn') value="mn">Mongolia</option>
                                            <option @selected($detail->flag == 'mo') value="mo">Macao</option>
                                            <option @selected($detail->flag == 'mp') value="mp">Northern Mariana Islands
                                            </option>
                                            <option @selected($detail->flag == 'mq') value="mq">Martinique</option>
                                            <option @selected($detail->flag == 'mr') value="mr">Mauritania</option>
                                            <option @selected($detail->flag == 'ms') value="ms">Montserrat</option>
                                            <option @selected($detail->flag == 'mt') value="mt">Malta</option>
                                            <option @selected($detail->flag == 'mu') value="mu">Mauritius</option>
                                            <option @selected($detail->flag == 'mv') value="mv">Maldives</option>
                                            <option @selected($detail->flag == 'mw') value="mw">Malawi</option>
                                            <option @selected($detail->flag == 'mx') value="mx">Mexico</option>
                                            <option @selected($detail->flag == 'my') value="my">Malaysia</option>
                                            <option @selected($detail->flag == 'mz') value="mz">Mozambique</option>
                                            <option @selected($detail->flag == 'na') value="na">Namibia</option>
                                            <option @selected($detail->flag == 'nc') value="nc">New Caledonia</option>
                                            <option @selected($detail->flag == 'ne') value="ne">Niger</option>
                                            <option @selected($detail->flag == 'nf') value="nf">Norfolk Island</option>
                                            <option @selected($detail->flag == 'ng') value="ng">Nigeria</option>
                                            <option @selected($detail->flag == 'ni') value="ni">Nicaragua</option>
                                            <option @selected($detail->flag == 'nl') value="nl">Netherlands</option>
                                            <option @selected($detail->flag == 'nl-fr') value="nl-fr">Friesland</option>
                                            <option @selected($detail->flag == 'no') value="no">Norway</option>
                                            <option @selected($detail->flag == 'np') value="np">Nepal</option>
                                            <option @selected($detail->flag == 'nr') value="nr">Nauru</option>
                                            <option @selected($detail->flag == 'nu') value="nu">Niue</option>
                                            <option @selected($detail->flag == 'nz') value="nz">New Zealand</option>
                                            <option @selected($detail->flag == 'om') value="om">Oman</option>
                                            <option @selected($detail->flag == 'pa') value="pa">Panama</option>
                                            <option @selected($detail->flag == 'pe') value="pe">Peru</option>
                                            <option @selected($detail->flag == 'pf') value="pf">French Polynesia</option>
                                            <option @selected($detail->flag == 'pg') value="pg">Papua New Guinea</option>
                                            <option @selected($detail->flag == 'ph') value="ph">Philippines</option>
                                            <option @selected($detail->flag == 'pk') value="pk">Pakistan</option>
                                            <option @selected($detail->flag == 'pk-jk') value="pk-jk">Azad Kashmir</option>
                                            <option @selected($detail->flag == 'pk-sd') value="pk-sd">Sindh</option>
                                            <option @selected($detail->flag == 'pl') value="pl">Poland</option>
                                            <option @selected($detail->flag == 'pm') value="pm">Saint Pierre and Miquelon
                                            </option>
                                            <option @selected($detail->flag == 'pn') value="pn">Pitcairn Islands</option>
                                            <option @selected($detail->flag == 'pr') value="pr">Puerto Rico</option>
                                            <option @selected($detail->flag == 'ps') value="ps">Palestine</option>
                                            <option @selected($detail->flag == 'pt-20') value="pt-20">Azores</option>
                                            <option @selected($detail->flag == 'pt-30') value="pt-30">Madeira</option>
                                            <option @selected($detail->flag == 'pt') value="pt">Portugal</option>
                                            <option @selected($detail->flag == 'pw') value="pw">Palau</option>
                                            <option @selected($detail->flag == 'py') value="py">Paraguay</option>
                                            <option @selected($detail->flag == 'qa') value="qa">Qatar</option>
                                            <option @selected($detail->flag == 're') value="re">Réunion</option>
                                            <option @selected($detail->flag == 'ro') value="ro">Romania</option>
                                            <option @selected($detail->flag == 'rs') value="rs">Serbia</option>
                                            <option @selected($detail->flag == 'ru') value="ru">Russia</option>
                                            <option @selected($detail->flag == 'ru-ba') value="ru-ba">Bashkortostan</option>
                                            <option @selected($detail->flag == 'ru-ce') value="ru-ce">Chechnya</option>
                                            <option @selected($detail->flag == 'ru-cu') value="ru-cu">Chuvashia</option>
                                            <option @selected($detail->flag == 'ru-da') value="ru-da">Dagestan</option>
                                            <option @selected($detail->flag == 'ru-dpr') value="ru-dpr">Donetsk People's Republic
                                            </option>
                                            <option @selected($detail->flag == 'ru-ko') value="ru-ko">Komi Republic</option>
                                            <option @selected($detail->flag == 'ru-lpr') value="ru-lpr">Luhansk People's Republic
                                            </option>
                                            <option @selected($detail->flag == 'ru-ta') value="ru-ta">Tatarstan</option>
                                            <option @selected($detail->flag == 'ru-ud') value="ru-ud">Udmurtia</option>
                                            <option @selected($detail->flag == 'rw') value="rw">Rwanda</option>
                                            <option @selected($detail->flag == 'sa') value="sa">Saudi Arabia</option>
                                            <option @selected($detail->flag == 'sb') value="sb">Solomon Islands</option>
                                            <option @selected($detail->flag == 'sc') value="sc">Seychelles</option>
                                            <option @selected($detail->flag == 'sd') value="sd">Sudan</option>
                                            <option @selected($detail->flag == 'se') value="se">Sweden</option>
                                            <option @selected($detail->flag == 'sg') value="sg">Singapore</option>
                                            <option @selected($detail->flag == 'sh-ac') value="sh-ac">Ascension Island</option>
                                            <option @selected($detail->flag == 'sh-hl') value="sh-hl">Saint Helena</option>
                                            <option @selected($detail->flag == 'sh-ta') value="sh-ta">Tristan da Cunha</option>
                                            <option @selected($detail->flag == 'si') value="si">Slovenia</option>
                                            <option @selected($detail->flag == 'sj') value="sj">Svalbard and Jan Mayen
                                            </option>
                                            <option @selected($detail->flag == 'sk') value="sk">Slovakia</option>
                                            <option @selected($detail->flag == 'sl') value="sl">Sierra Leone</option>
                                            <option @selected($detail->flag == 'sm') value="sm">San Marino</option>
                                            <option @selected($detail->flag == 'sn') value="sn">Senegal</option>
                                            <option @selected($detail->flag == 'so') value="so">Somalia</option>
                                            <option @selected($detail->flag == 'os') value="os">South Ossetia</option>
                                            <option @selected($detail->flag == 'su') value="su">Soviet Union</option>
                                            <option @selected($detail->flag == 'sr') value="sr">Suriname</option>
                                            <option @selected($detail->flag == 'ss') value="ss">South Sudan</option>
                                            <option @selected($detail->flag == 'st') value="st">São Tomé and Príncipe
                                            </option>
                                            <option @selected($detail->flag == 'sv') value="sv">El Salvador</option>
                                            <option @selected($detail->flag == 'sx') value="sx">Sint Maarten</option>
                                            <option @selected($detail->flag == 'sy') value="sy">Syria</option>
                                            <option @selected($detail->flag == 'sz') value="sz">Eswatini</option>
                                            <option @selected($detail->flag == 'tc') value="tc">Turks and Caicos Islands
                                            </option>
                                            <option @selected($detail->flag == 'td') value="td">Chad</option>
                                            <option @selected($detail->flag == 'tf') value="tf">French Southern
                                                Territories</option>
                                            <option @selected($detail->flag == 'tg') value="tg">Togo</option>
                                            <option @selected($detail->flag == 'th') value="th">Thailand</option>
                                            <option @selected($detail->flag == 'tibet') value="tibet">Tibet</option>
                                            <option @selected($detail->flag == 'tj') value="tj">Tajikistan</option>
                                            <option @selected($detail->flag == 'tk') value="tk">Tokelau</option>
                                            <option @selected($detail->flag == 'tl') value="tl">Timor-Leste</option>
                                            <option @selected($detail->flag == 'tm') value="tm">Turkmenistan</option>
                                            <option @selected($detail->flag == 'tn') value="tn">Tunisia</option>
                                            <option @selected($detail->flag == 'to') value="to">Tonga</option>
                                            <option @selected($detail->flag == 'tr') value="tr">Turkey</option>
                                            <option @selected($detail->flag == 'transnistria') value="transnistria">Transnistria
                                            </option>
                                            <option @selected($detail->flag == 'tt') value="tt">Trinidad and Tobago
                                            </option>
                                            <option @selected($detail->flag == 'tv') value="tv">Tuvalu</option>
                                            <option @selected($detail->flag == 'tw') value="tw">Taiwan</option>
                                            <option @selected($detail->flag == 'tz') value="tz">Tanzania</option>
                                            <option @selected($detail->flag == 'ua') value="ua">Ukraine</option>
                                            <option @selected($detail->flag == 'ug') value="ug">Uganda</option>
                                            <option @selected($detail->flag == 'un') value="un">United Nations</option>
                                            <option @selected($detail->flag == 'us') value="us">United States of America
                                            </option>
                                            <option @selected($detail->flag == 'us-ak') value="us-ak">Alaska</option>
                                            <option @selected($detail->flag == 'us-al') value="us-al">Alabama</option>
                                            <option @selected($detail->flag == 'us-ar') value="us-ar">Arkansas</option>
                                            <option @selected($detail->flag == 'us-az') value="us-az">Arizona</option>
                                            <option @selected($detail->flag == 'us-ca') value="us-ca">California</option>
                                            <option @selected($detail->flag == 'us-co') value="us-co">Colorado</option>
                                            <option @selected($detail->flag == 'us-dc') value="us-dc">District of Columbia
                                            </option>
                                            <option @selected($detail->flag == 'us-fl') value="us-fl">Florida</option>
                                            <option @selected($detail->flag == 'us-ga') value="us-ga">Georgia</option>
                                            <option @selected($detail->flag == 'us-hi') value="us-hi">Hawaii</option>
                                            <option @selected($detail->flag == 'us-in') value="us-in">Indiana</option>
                                            <option @selected($detail->flag == 'us-md') value="us-md">Maryland</option>
                                            <option @selected($detail->flag == 'us-mo') value="us-mo">Missouri</option>
                                            <option @selected($detail->flag == 'us-ms') value="us-ms">Mississippi</option>
                                            <option @selected($detail->flag == 'us-nc') value="us-nc">North Carolina</option>
                                            <option @selected($detail->flag == 'us-nm') value="us-nm">New Mexico</option>
                                            <option @selected($detail->flag == 'us-or') value="us-or">Oregon</option>
                                            <option @selected($detail->flag == 'us-ri') value="us-ri">Rhode Island</option>
                                            <option @selected($detail->flag == 'us-sc') value="us-sc">South Carolina</option>
                                            <option @selected($detail->flag == 'us-tn') value="us-tn">Tennessee</option>
                                            <option @selected($detail->flag == 'us-tx') value="us-tx">Texas</option>
                                            <option @selected($detail->flag == 'us-wa') value="us-wa">Washington</option>
                                            <option @selected($detail->flag == 'us-wi') value="us-wi">Wisconsin</option>
                                            <option @selected($detail->flag == 'us-wy') value="us-wy">Wyoming</option>
                                            <option @selected($detail->flag == 'us-betsy_ross') value="us-betsy_ross">Betsy Ross
                                            </option>
                                            <option @selected($detail->flag == 'us-confederate_battle') value="us-confederate_battle">
                                                Confederate battle</option>
                                            <option @selected($detail->flag == 'um') value="um">United States Minor
                                                Outlying Islands</option>
                                            <option @selected($detail->flag == 'uy') value="uy">Uruguay</option>
                                            <option @selected($detail->flag == 'uz') value="uz">Uzbekistan</option>
                                            <option @selected($detail->flag == 'va') value="va">Holy See (Vatican)
                                            </option>
                                            <option @selected($detail->flag == 'vc') value="vc">Saint Vincent and the
                                                Grenadines</option>
                                            <option @selected($detail->flag == 've') value="ve">Venezuela</option>
                                            <option @selected($detail->flag == 'vg') value="vg">Virgin Islands (British)
                                            </option>
                                            <option @selected($detail->flag == 'vi') value="vi">Virgin Islands (U.S.)
                                            </option>
                                            <option @selected($detail->flag == 'vn') value="vn">Vietnam</option>
                                            <option @selected($detail->flag == 'vu') value="vu">Vanuatu</option>
                                            <option @selected($detail->flag == 'wf') value="wf">Wallis and Futuna
                                            </option>
                                            <option @selected($detail->flag == 'wiphala') value="wiphala">Wiphala</option>
                                            <option @selected($detail->flag == 'ws') value="ws">Samoa</option>
                                            <option @selected($detail->flag == 'xk') value="xk">Kosovo</option>
                                            <option @selected($detail->flag == 'xx') value="xx">&lt;Placeholder&gt;
                                            </option>
                                            <option @selected($detail->flag == 'ye') value="ye">Yemen</option>
                                            <option @selected($detail->flag == 'yorubaland') value="yorubaland">Yorubaland</option>
                                            <option @selected($detail->flag == 'yt') value="yt">Mayotte</option>
                                            <option @selected($detail->flag == 'yu') value="yu">Yugoslavia</option>
                                            <option @selected($detail->flag == 'za') value="za">South Africa</option>
                                            <option @selected($detail->flag == 'zm') value="zm">Zambia</option>
                                            <option @selected($detail->flag == 'zw') value="zw">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="mp3-buttons">
                                <div class="ai-checkbox">
                                    <input type="checkbox" name="ai-checkbox[]" id="ai-checkbox" />
                                    <label for="ai-checkbox">AI generate MP3</label>
                                </div>
                                <div class="audio-input">
                                    <input type="file" id="audioInput{{ $detail->id }}" class="d-none"
                                        name="audio{{ $detail->id }}[]"
                                        onchange="showFileName('select-audio{{ $detail->id }}','audioInput{{ $detail->id }}')"
                                        accept="audio/*" multiple />
                                    <div class=""></div>
                                    {{-- <div class="selected-file" id="selectedFile">Upload Logo</div> --}}
                                    <div class="input-box cursor-pointer" id="select-audio{{ $key }}"
                                        onclick="fileInputClick('audioInput{{ $detail->id }}')">Upload some MP3 sounds
                                    </div>
                                    <div class="input-icon cursor-pointer" id="recordButton">
                                        <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                                    </div>
                                    <div class="input-icon cursor-pointer d-none" id="stopButton">
                                        <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                                    </div>
                                </div>
                            </div>
                            <div class="playback mt-2">
                                <audio src="" controls id="audio-playback" class="d-none"></audio>
                            </div>
                            <div class="input-large-box cursor-pointer"
                                onclick="fileInputClick('imageInput{{ $detail->id }}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/photo-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedLogo{{ $detail->id }}">Upload Photos</div>
                                <input type="file" id="imageInput{{ $detail->id }}" class="d-none"
                                    name="logo{{ $key }}[]"
                                    onchange="showFileName('selectedLogo{{ $detail->id }}','imageInput{{ $detail->id }}')"
                                    accept="image/*" multiple />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer"
                                onclick="fileInputClick('videoInput{{ $detail->id }}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/upload-icon-large.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedVideo{{ $detail->id }}">Upload videos</div>
                                <input type="file" id="videoInput{{ $detail->id }}" class="d-none" name="video[]"
                                    onchange="showFileName('selectedVideo{{ $detail->id }}','videoInput{{ $detail->id }}')"
                                    accept="video/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer"
                                onclick="fileInputClick('fileInput{{ $detail->id }}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/star-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedFile{{ $detail->id }}">Upload 3D Object</div>
                                <input type="file" id="fileInput{{ $detail->id }}" class="d-none" name="object[]"
                                    onchange="showFileName('selectedFile{{ $detail->id }}','fileInput{{ $detail->id }}')" />
                                <div class=""></div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="submit-details">
                    <button type="submit">SAVE</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function showFileName(id, value) {
            const fileInput = document.getElementById(value);
            const selectedFile = document.getElementById(id);
            const fileName = fileInput.files[0].name;
            selectedFile.innerHTML = `${fileName}`;
        }

        function changeBoxColor(inputId, id) {
            const colorInput = document.getElementById(inputId).value;
            const selectedBox = document.getElementById(id);
            // const fileName = colorInput.files[0].name;
            // selectedFile.innerHTML = `${fileName}`;
            selectedBox.style.backgroundColor = colorInput;
        }

        function fileInputClick(id) {
            document.getElementById(id).click();
        }

        document.getElementById("defaultOpen").click();

        function changeTab(evt, tabName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

    <script>
        $(document).ready(function() {
            let keyId = parseInt('{{ $poi->details->count() }}') + 1;
            $('.add-lang-btn').click(function() {
                var randomId = Math.random().toString(36).substring(7);
                var newFlagSection = `
                <div class="tablinks" id="defaultOpen" onclick="changeTab(event, '${randomId}')">
                    <img src="{{ asset('images/error_log.png') }}" alt="" width="40">
                </div>`;
                $('.flags-section').children('div').eq(-1).before(newFlagSection);
                $('#main-lang-div').append(`
                        <div id="${randomId}" class="tab-content" style="display: none;">
                            <input type="hidden" name="main_id[]" value="${randomId}">
                            <div class="title-1">
                                <input type="text" class="form-control" value="" name="title[]">
                            </div>
                            <div class="paragraph">
                                <textarea name="description[]" id="" class="form-control" rows="10"></textarea>
                            </div>

                            <div class="mt-2 flag-language">
                                <div class="row">
                                    <div class="col-md-6 p-1">
                                        <sub for="">Language</sub>
                                <select name="language[]" id="language" class="form-control select2">
                                    <option value="en">English</option>
                                    <option value="ar">Arabic</option>
                                    <option value="de">German</option>
                                    <option value="fr">French</option>
                                    <option value="es">Spanish</option>
                                    <option value="it">Italian</option>
                                    <option value="nl">Dutch</option>
                                    <option value="ja">Japanese</option>
                                    <option value="ko">Korean</option>
                                    <option value="pt">Portuguese</option>
                                    <option value="ru">Russian</option>
                                    <option value="zh">Chinese</option>
                                    <option value="hi">Hindi</option>
                                    <option value="tr">Turkish</option>
                                    <option value="id">Indonesian</option>
                                    <option value="vi">Vietnamese</option>
                                    <option value="th">Thai</option>
                                    <option value="el">Greek</option>
                                    <option value="sv">Swedish</option>
                                    <option value="pl">Polish</option>
                                    <option value="da">Danish</option>
                                    <option value="fi">Finnish</option>
                                    <option value="no">Norwegian</option>
                                    <option value="he">Hebrew</option>
                                    <option value="cs">Czech</option>
                                    <option value="hu">Hungarian</option>
                                    <option value="ro">Romanian</option>
                                    <option value="sk">Slovak</option>
                                    <option value="uk">Ukrainian</option>
                                    <option value="bg">Bulgarian</option>
                                    <option value="sr">Serbian</option>
                                    <option value="hr">Croatian</option>
                                    <option value="sl">Slovenian</option>
                                    <option value="et">Estonian</option>
                                    <option value="lt">Lithuanian</option>
                                    <option value="lv">Latvian</option>
                                    <option value="mk">Macedonian</option>
                                    <option value="sq">Albanian</option>
                                    <option value="hy">Armenian</option>
                                    <option value="az">Azerbaijani</option>
                                    <option value="eu">Basque</option>
                                    <option value="be">Belarusian</option>
                                    <option value="bs">Bosnian</option>
                                    <option value="ka">Georgian</option>
                                    <option value="is">Icelandic</option>
                                    <option value="gl">Galician</option>
                                    <option value="mt">Maltese</option>
                                    <option value="et">Estonian</option>
                                    <option value="lb">Luxembourgish</option>
                                    <option value="mk">Macedonian</option>
                                    <option value="mn">Mongolian</option>
                                    <option value="ne">Nepali</option>
                                    <option value="ps">Pashto</option>
                                    <option value="fa">Persian</option>
                                    <option value="rw">Kinyarwanda</option>
                                    <option value="si">Sinhala</option>
                                    <option value="so">Somali</option>
                                    <option value="ta">Tamil</option>
                                    <option value="te">Telugu</option>
                                    <option value="ur">Urdu</option>
                                    <option value="yo">Yoruba</option>
                                    <option value="zu">Zulu</option>
                                </select>
                                </div>
                                <div class="col-md-6 p-1">
                                    <sub for="">Country</sub>
                                        <select name="flag[]" id="flag" class="form-control select2">
                                            <option value="ad">Andorra</option>
                                            <option value="ae">United Arab Emirates</option>
                                            <option value="af">Afghanistan</option>
                                            <option value="ag">Antigua and Barbuda</option>
                                            <option value="ai">Anguilla</option>
                                            <option value="al">Albania</option>
                                            <option value="am">Armenia</option>
                                            <option value="an">Netherlands Antilles</option>
                                            <option value="ao">Angola</option>
                                            <option value="aq">Antarctica</option>
                                            <option value="ar">Argentina</option>
                                            <option value="as">American Samoa</option>
                                            <option value="at">Austria</option>
                                            <option value="au">Australia</option>
                                            <option value="au-aboriginal">Australian Aboriginal</option>
                                            <option value="au-torres_strait_islands">Torres Strait Islands</option>
                                            <option value="au-act">Australian Capital Territory</option>
                                            <option value="au-nsw">New South Wales</option>
                                            <option value="au-nt">Northern Territory</option>
                                            <option value="au-qld">Queensland</option>
                                            <option value="au-sa">South Australia</option>
                                            <option value="au-tas">Tasmania</option>
                                            <option value="au-vic">Victoria</option>
                                            <option value="au-wa">Western Australia</option>
                                            <option value="aw">Aruba</option>
                                            <option value="ax">Åland Islands</option>
                                            <option value="az">Azerbaijan</option>
                                            <option value="ba">Bosnia and Herzegovina</option>
                                            <option value="bb">Barbados</option>
                                            <option value="bd">Bangladesh</option>
                                            <option value="be">Belgium</option>
                                            <option value="bf">Burkina Faso</option>
                                            <option value="bg">Bulgaria</option>
                                            <option value="bh">Bahrain</option>
                                            <option value="bi">Burundi</option>
                                            <option value="bj">Benin</option>
                                            <option value="bl">Saint Barthélemy</option>
                                            <option value="bm">Bermuda</option>
                                            <option value="bn">Brunei</option>
                                            <option value="bo">Bolivia</option>
                                            <option value="bq-bo">Bonaire</option>
                                            <option value="bq-sa">Saba</option>
                                            <option value="bq-se">Sint Eustatius</option>
                                            <option value="br">Brazil</option>
                                            <option value="bs">Bahamas</option>
                                            <option value="bt">Bhutan</option>
                                            <option value="bv">Bouvet Island</option>
                                            <option value="bw">Botswana</option>
                                            <option value="by">Belarus</option>
                                            <option value="bz">Belize</option>
                                            <option value="ca">Canada</option>
                                            <option value="ca-bc">British Columbia</option>
                                            <option value="ca-qc">Quebec</option>
                                            <option value="cc">Cocos</option>
                                            <option value="cd">Congo, Democratic Republic of the</option>
                                            <option value="cf">Central African Republic</option>
                                            <option value="cg">Congo</option>
                                            <option value="ch">Switzerland</option>
                                            <option value="ch-gr">Grisons</option>
                                            <option value="ci">Ivory Coast</option>
                                            <option value="ck">Cook Islands</option>
                                            <option value="cl">Chile</option>
                                            <option value="cm">Cameroon</option>
                                            <option value="cn">China</option>
                                            <option value="cn-xj">Xinjiang</option>
                                            <option value="co">Colombia</option>
                                            <option value="cq">Sark</option>
                                            <option value="cr">Costa Rica</option>
                                            <option value="cu">Cuba</option>
                                            <option value="cv">Cabo Verde</option>
                                            <option value="cw">Curaçao</option>
                                            <option value="cx">Christmas Island</option>
                                            <option value="cy">Cyprus</option>
                                            <option value="cz">Czechia</option>
                                            <option value="de">Germany</option>
                                            <option value="dj">Djibouti</option>
                                            <option value="dk">Denmark</option>
                                            <option value="dm">Dominica</option>
                                            <option value="do">Dominican Republic</option>
                                            <option value="dz">Algeria</option>
                                            <option value="east_african_federation">East African Federation</option>
                                            <option value="easter_island">Easter Island</option>
                                            <option value="ec">Ecuador</option>
                                            <option value="ec-w">Galápagos</option>
                                            <option value="ee">Estonia</option>
                                            <option value="eg">Egypt</option>
                                            <option value="eh">Western Sahara</option>
                                            <option value="er">Eritrea</option>
                                            <option value="es">Spain</option>
                                            <option value="ad">Andorra</option>
                                            <option value="ae">United Arab Emirates</option>
                                            <option value="af">Afghanistan</option>
                                            <option value="ag">Antigua and Barbuda</option>
                                            <option value="ai">Anguilla</option>
                                            <option value="al">Albania</option>
                                            <option value="am">Armenia</option>
                                            <option value="an">Netherlands Antilles</option>
                                            <option value="ao">Angola</option>
                                            <option value="aq">Antarctica</option>
                                            <option value="ar">Argentina</option>
                                            <option value="as">American Samoa</option>
                                            <option value="at">Austria</option>
                                            <option value="au">Australia</option>
                                            <option value="au-aboriginal">Australian Aboriginal</option>
                                            <option value="au-torres_strait_islands">Torres Strait Islands</option>
                                            <option value="au-act">Australian Capital Territory</option>
                                            <option value="au-nsw">New South Wales</option>
                                            <option value="au-nt">Northern Territory</option>
                                            <option value="au-qld">Queensland</option>
                                            <option value="au-sa">South Australia</option>
                                            <option value="au-tas">Tasmania</option>
                                            <option value="au-vic">Victoria</option>
                                            <option value="au-wa">Western Australia</option>
                                            <option value="aw">Aruba</option>
                                            <option value="ax">Åland Islands</option>
                                            <option value="az">Azerbaijan</option>
                                            <option value="ba">Bosnia and Herzegovina</option>
                                            <option value="bb">Barbados</option>
                                            <option value="bd">Bangladesh</option>
                                            <option value="be">Belgium</option>
                                            <option value="bf">Burkina Faso</option>
                                            <option value="bg">Bulgaria</option>
                                            <option value="bh">Bahrain</option>
                                            <option value="bi">Burundi</option>
                                            <option value="bj">Benin</option>
                                            <option value="bl">Saint Barthélemy</option>
                                            <option value="bm">Bermuda</option>
                                            <option value="bn">Brunei</option>
                                            <option value="bo">Bolivia</option>
                                            <option value="bq-bo">Bonaire</option>
                                            <option value="bq-sa">Saba</option>
                                            <option value="bq-se">Sint Eustatius</option>
                                            <option value="br">Brazil</option>
                                            <option value="bs">Bahamas</option>
                                            <option value="bt">Bhutan</option>
                                            <option value="bv">Bouvet Island</option>
                                            <option value="bw">Botswana</option>
                                            <option value="by">Belarus</option>
                                            <option value="bz">Belize</option>
                                            <option value="ca">Canada</option>
                                            <option value="ca-bc">British Columbia</option>
                                            <option value="ca-qc">Quebec</option>
                                            <option value="cc">Cocos (Keeling) Islands</option>
                                            <option value="cd">Congo, Democratic Republic of the</option>
                                            <option value="cf">Central African Republic</option>
                                            <option value="cg">Congo</option>
                                            <option value="ch">Switzerland</option>
                                            <option value="ch-gr">Grisons</option>
                                            <option value="ci">Ivory Coast</option>
                                            <option value="ck">Cook Islands</option>
                                            <option value="cl">Chile</option>
                                            <option value="cm">Cameroon</option>
                                            <option value="cn">China</option>
                                            <option value="cn-xj">Xinjiang</option>
                                            <option value="co">Colombia</option>
                                            <option value="cq">Sark</option>
                                            <option value="cr">Costa Rica</option>
                                            <option value="cu">Cuba</option>
                                            <option value="cv">Cabo Verde</option>
                                            <option value="cw">Curaçao</option>
                                            <option value="cx">Christmas Island</option>
                                            <option value="cy">Cyprus</option>
                                            <option value="cz">Czechia</option>
                                            <option value="de">Germany</option>
                                            <option value="dj">Djibouti</option>
                                            <option value="dk">Denmark</option>
                                            <option value="dm">Dominica</option>
                                            <option value="do">Dominican Republic</option>
                                            <option value="dz">Algeria</option>
                                            <option value="earth">Earth</option>
                                            <option value="east_african_federation">East African Federation</option>
                                            <option value="easter_island">Easter Island</option>
                                            <option value="ec">Ecuador</option>
                                            <option value="ec-w">Galápagos</option>
                                            <option value="ee">Estonia</option>
                                            <option value="eg">Egypt</option>
                                            <option value="eh">Western Sahara</option>
                                            <option value="er">Eritrea</option>
                                            <option value="es">Spain</option>
                                            <option value="es-ar">Aragon</option>
                                            <option value="es-ce">Ceuta</option>
                                            <option value="es-cn">Canary Islands</option>
                                            <option value="es-ct">Catalonia</option>
                                            <option value="es-ga">Galicia</option>
                                            <option value="es-ib">Balearic Islands</option>
                                            <option value="es-ml">Melilla</option>
                                            <option value="es-pv">Basque Country</option>
                                            <option value="et">Ethiopia</option>
                                            <option value="et-af">Afar</option>
                                            <option value="et-am">Amhara</option>
                                            <option value="et-be">Benishangul-Gumuz</option>
                                            <option value="et-ga">Gambela</option>
                                            <option value="et-ha">Harari</option>
                                            <option value="et-or">Oromia</option>
                                            <option value="et-si">Sidama</option>
                                            <option value="et-sn">Southern Nations, Nationalities, and Peoples' Region
                                            </option>
                                            <option value="et-so">Somali</option>
                                            <option value="et-sw">South West Region</option>
                                            <option value="et-ti">Tigray</option>
                                            <option value="eu">European Union</option>
                                            <option value="ewe">Ewe</option>
                                            <option value="fi">Finland</option>
                                            <option value="fj">Fiji</option>
                                            <option value="fk">Falkland Islands (Malvinas)</option>
                                            <option value="fm">Micronesia</option>
                                            <option value="fo">Faroe Islands</option>
                                            <option value="fr">France</option>
                                            <option value="fr-20r">Corsica</option>
                                            <option value="fr-bre">Brittany</option>
                                            <option value="fr-cp">Clipperton Island</option>
                                            <option value="ga">Gabon</option>
                                            <option value="gb">United Kingdom</option>
                                            <option value="gb-con">Cornwall</option>
                                            <option value="gb-eng">England</option>
                                            <option value="gb-nir">Northern Ireland</option>
                                            <option value="gb-ork">Orkney</option>
                                            <option value="gb-sct">Scotland</option>
                                            <option value="gb-wls">Wales</option>
                                            <option value="gd">Grenada</option>
                                            <option value="ge">Georgia</option>
                                            <option value="ge-ab">Abkhazia</option>
                                            <option value="gf">French Guiana</option>
                                            <option value="gg">Guernsey</option>
                                            <option value="gh">Ghana</option>
                                            <option value="gi">Gibraltar</option>
                                            <option value="gl">Greenland</option>
                                            <option value="gm">Gambia</option>
                                            <option value="gn">Guinea</option>
                                            <option value="gp">Guadeloupe</option>
                                            <option value="gq">Equatorial Guinea</option>
                                            <option value="gr">Greece</option>
                                            <option value="gs">South Georgia and the South Sandwich Islands</option>
                                            <option value="gt">Guatemala</option>
                                            <option value="gu">Guam</option>
                                            <option value="guarani">Guarani</option>
                                            <option value="gw">Guinea-Bissau</option>
                                            <option value="gy">Guyana</option>
                                            <option value="hausa">Hausa</option>
                                            <option value="hk">Hong Kong</option>
                                            <option value="hm">Heard Island and McDonald Islands</option>
                                            <option value="hn">Honduras</option>
                                            <option value="hr">Croatia</option>
                                            <option value="ht">Haiti</option>
                                            <option value="hu">Hungary</option>
                                            <option value="id">Indonesia</option>
                                            <option value="id-jb">West Java</option>
                                            <option value="id-jt">Central Java</option>
                                            <option value="ie">Ireland</option>
                                            <option value="il">Israel</option>
                                            <option value="im">Isle of Man</option>
                                            <option value="in">India</option>
                                            <option value="in-as">Assam</option>
                                            <option value="in-gj">Gujarat</option>
                                            <option value="in-ka">Karnataka</option>
                                            <option value="in-mn">Manipur</option>
                                            <option value="in-mz">Mizoram</option>
                                            <option value="in-or">Odisha</option>
                                            <option value="in-tg">Telangana</option>
                                            <option value="in-tn">Tamil Nadu</option>
                                            <option value="io">British Indian Ocean Territory</option>
                                            <option value="iq">Iraq</option>
                                            <option value="iq-kr">Kurdistan</option>
                                            <option value="ir">Iran</option>
                                            <option value="is">Iceland</option>
                                            <option value="it">Italy</option>
                                            <option value="it-21">Piedmont</option>
                                            <option value="it-23">Aosta Valley</option>
                                            <option value="it-25">Lombardy</option>
                                            <option value="it-32">Trentino-Alto Adige</option>
                                            <option value="it-34">Veneto</option>
                                            <option value="it-36">Friuli Venezia Giulia</option>
                                            <option value="it-42">Liguria</option>
                                            <option value="it-45">Emilia-Romagna</option>
                                            <option value="it-52">Tuscany</option>
                                            <option value="it-55">Umbria</option>
                                            <option value="it-57">Marche</option>
                                            <option value="it-62">Lazio</option>
                                            <option value="it-65">Abruzzo</option>
                                            <option value="it-67">Molise</option>
                                            <option value="it-72">Campania</option>
                                            <option value="it-75">Apulia</option>
                                            <option value="it-77">Basilicata</option>
                                            <option value="it-78">Calabria</option>
                                            <option value="it-82">Sicily</option>
                                            <option value="it-88">Sardinia</option>
                                            <option value="je">Jersey</option>
                                            <option value="jm">Jamaica</option>
                                            <option value="jo">Jordan</option>
                                            <option value="jp">Japan</option>
                                            <option value="ke">Kenya</option>
                                            <option value="kg">Kyrgyzstan</option>
                                            <option value="kh">Cambodia</option>
                                            <option value="ki">Kiribati</option>
                                            <option value="km">Comoros</option>
                                            <option value="kn">Saint Kitts and Nevis</option>
                                            <option value="kp">North Korea</option>
                                            <option value="kr">South Korea</option>
                                            <option value="kw">Kuwait</option>
                                            <option value="ky">Cayman Islands</option>
                                            <option value="kz">Kazakhstan</option>
                                            <option value="la">Laos</option>
                                            <option value="lb">Lebanon</option>
                                            <option value="lc">Saint Lucia</option>
                                            <option value="li">Liechtenstein</option>
                                            <option value="lk">Sri Lanka</option>
                                            <option value="lr">Liberia</option>
                                            <option value="ls">Lesotho</option>
                                            <option value="lt">Lithuania</option>
                                            <option value="lu">Luxembourg</option>
                                            <option value="lv">Latvia</option>
                                            <option value="ly">Libya</option>
                                            <option value="ma">Morocco</option>
                                            <option value="mc">Monaco</option>
                                            <option value="md">Moldova</option>
                                            <option value="me">Montenegro</option>
                                            <option value="mf">Saint-Martin</option>
                                            <option value="mg">Madagascar</option>
                                            <option value="mh">Marshall Islands</option>
                                            <option value="mk">North Macedonia</option>
                                            <option value="ml">Mali</option>
                                            <option value="mm">Myanmar</option>
                                            <option value="mn">Mongolia</option>
                                            <option value="mo">Macao</option>
                                            <option value="mp">Northern Mariana Islands</option>
                                            <option value="mq">Martinique</option>
                                            <option value="mr">Mauritania</option>
                                            <option value="ms">Montserrat</option>
                                            <option value="mt">Malta</option>
                                            <option value="mu">Mauritius</option>
                                            <option value="mv">Maldives</option>
                                            <option value="mw">Malawi</option>
                                            <option value="mx">Mexico</option>
                                            <option value="my">Malaysia</option>
                                            <option value="mz">Mozambique</option>
                                            <option value="na">Namibia</option>
                                            <option value="nc">New Caledonia</option>
                                            <option value="ne">Niger</option>
                                            <option value="nf">Norfolk Island</option>
                                            <option value="ng">Nigeria</option>
                                            <option value="ni">Nicaragua</option>
                                            <option value="nl">Netherlands</option>
                                            <option value="nl-fr">Friesland</option>
                                            <option value="no">Norway</option>
                                            <option value="np">Nepal</option>
                                            <option value="nr">Nauru</option>
                                            <option value="nu">Niue</option>
                                            <option value="nz">New Zealand</option>
                                            <option value="om">Oman</option>
                                            <option value="pa">Panama</option>
                                            <option value="pe">Peru</option>
                                            <option value="pf">French Polynesia</option>
                                            <option value="pg">Papua New Guinea</option>
                                            <option value="ph">Philippines</option>
                                            <option value="pk">Pakistan</option>
                                            <option value="pk-jk">Azad Kashmir</option>
                                            <option value="pk-sd">Sindh</option>
                                            <option value="pl">Poland</option>
                                            <option value="pm">Saint Pierre and Miquelon</option>
                                            <option value="pn">Pitcairn Islands</option>
                                            <option value="pr">Puerto Rico</option>
                                            <option value="ps">Palestine</option>
                                            <option value="pt-20">Azores</option>
                                            <option value="pt-30">Madeira</option>
                                            <option value="pt">Portugal</option>
                                            <option value="pw">Palau</option>
                                            <option value="py">Paraguay</option>
                                            <option value="qa">Qatar</option>
                                            <option value="re">Réunion</option>
                                            <option value="ro">Romania</option>
                                            <option value="rs">Serbia</option>
                                            <option value="ru">Russia</option>
                                            <option value="ru-ba">Bashkortostan</option>
                                            <option value="ru-ce">Chechnya</option>
                                            <option value="ru-cu">Chuvashia</option>
                                            <option value="ru-da">Dagestan</option>
                                            <option value="ru-dpr">Donetsk People's Republic</option>
                                            <option value="ru-ko">Komi Republic</option>
                                            <option value="ru-lpr">Luhansk People's Republic</option>
                                            <option value="ru-ta">Tatarstan</option>
                                            <option value="ru-ud">Udmurtia</option>
                                            <option value="rw">Rwanda</option>
                                            <option value="sa">Saudi Arabia</option>
                                            <option value="sb">Solomon Islands</option>
                                            <option value="sc">Seychelles</option>
                                            <option value="sd">Sudan</option>
                                            <option value="se">Sweden</option>
                                            <option value="sg">Singapore</option>
                                            <option value="sh-ac">Ascension Island</option>
                                            <option value="sh-hl">Saint Helena</option>
                                            <option value="sh-ta">Tristan da Cunha</option>
                                            <option value="si">Slovenia</option>
                                            <option value="sj">Svalbard and Jan Mayen</option>
                                            <option value="sk">Slovakia</option>
                                            <option value="sl">Sierra Leone</option>
                                            <option value="sm">San Marino</option>
                                            <option value="sn">Senegal</option>
                                            <option value="so">Somalia</option>
                                            <option value="os">South Ossetia</option>
                                            <option value="su">Soviet Union</option>
                                            <option value="sr">Suriname</option>
                                            <option value="ss">South Sudan</option>
                                            <option value="st">São Tomé and Príncipe</option>
                                            <option value="sv">El Salvador</option>
                                            <option value="sx">Sint Maarten</option>
                                            <option value="sy">Syria</option>
                                            <option value="sz">Eswatini</option>
                                            <option value="tc">Turks and Caicos Islands</option>
                                            <option value="td">Chad</option>
                                            <option value="tf">French Southern Territories</option>
                                            <option value="tg">Togo</option>
                                            <option value="th">Thailand</option>
                                            <option value="tibet">Tibet</option>
                                            <option value="tj">Tajikistan</option>
                                            <option value="tk">Tokelau</option>
                                            <option value="tl">Timor-Leste</option>
                                            <option value="tm">Turkmenistan</option>
                                            <option value="tn">Tunisia</option>
                                            <option value="to">Tonga</option>
                                            <option value="tr">Turkey</option>
                                            <option value="transnistria">Transnistria</option>
                                            <option value="tt">Trinidad and Tobago</option>
                                            <option value="tv">Tuvalu</option>
                                            <option value="tw">Taiwan</option>
                                            <option value="tz">Tanzania</option>
                                            <option value="ua">Ukraine</option>
                                            <option value="ug">Uganda</option>
                                            <option value="un">United Nations</option>
                                            <option value="us">United States of America</option>
                                            <option value="us-ak">Alaska</option>
                                            <option value="us-al">Alabama</option>
                                            <option value="us-ar">Arkansas</option>
                                            <option value="us-az">Arizona</option>
                                            <option value="us-ca">California</option>
                                            <option value="us-co">Colorado</option>
                                            <option value="us-dc">District of Columbia</option>
                                            <option value="us-fl">Florida</option>
                                            <option value="us-ga">Georgia</option>
                                            <option value="us-hi">Hawaii</option>
                                            <option value="us-in">Indiana</option>
                                            <option value="us-md">Maryland</option>
                                            <option value="us-mo">Missouri</option>
                                            <option value="us-ms">Mississippi</option>
                                            <option value="us-nc">North Carolina</option>
                                            <option value="us-nm">New Mexico</option>
                                            <option value="us-or">Oregon</option>
                                            <option value="us-ri">Rhode Island</option>
                                            <option value="us-sc">South Carolina</option>
                                            <option value="us-tn">Tennessee</option>
                                            <option value="us-tx">Texas</option>
                                            <option value="us-wa">Washington</option>
                                            <option value="us-wi">Wisconsin</option>
                                            <option value="us-wy">Wyoming</option>
                                            <option value="us-betsy_ross">Betsy Ross</option>
                                            <option value="us-confederate_battle">Confederate battle</option>
                                            <option value="um">United States Minor Outlying Islands</option>
                                            <option value="uy">Uruguay</option>
                                            <option value="uz">Uzbekistan</option>
                                            <option value="va">Holy See (Vatican)</option>
                                            <option value="vc">Saint Vincent and the Grenadines</option>
                                            <option value="ve">Venezuela</option>
                                            <option value="vg">Virgin Islands (British)</option>
                                            <option value="vi">Virgin Islands (U.S.)</option>
                                            <option value="vn">Vietnam</option>
                                            <option value="vu">Vanuatu</option>
                                            <option value="wf">Wallis and Futuna</option>
                                            <option value="wiphala">Wiphala</option>
                                            <option value="ws">Samoa</option>
                                            <option value="xk">Kosovo</option>
                                            <option value="xx">&lt;Placeholder&gt;</option>
                                            <option value="ye">Yemen</option>
                                            <option value="yorubaland">Yorubaland</option>
                                            <option value="yt">Mayotte</option>
                                            <option value="yu">Yugoslavia</option>
                                            <option value="za">South Africa</option>
                                            <option value="zm">Zambia</option>
                                            <option value="zw">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mp3-buttons">
                                <div class="ai-checkbox">
                                    <input type="checkbox" name="ai-checkbox[]" id="ai-checkbox" />
                                    <label for="ai-checkbox">AI generate MP3</label>
                                </div>
                                <div class="audio-input cursor-pointer" onclick="fileInputClick('audioInput${randomId}')">
                                    <input type="file" id="audioInput${randomId}" class="d-none" name="audio${keyId}[]"
                                        onchange="showFileName('select-audio${randomId}','audioInput${randomId}')" accept="audio/*" multiple/>
                                    <div class=""></div>
                                    <div class="input-box" id="select-audio${randomId}">Upload some MP3 sounds</div>
                                    <div class="input-icon">
                                        <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                                    </div>
                                </div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('imageInput${randomId}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/photo-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedLogo${randomId}">Upload Logo</div>
                                <input type="file" id="imageInput${randomId}" class="d-none" name="logo${keyId}[]"
                                    onchange="showFileName('selectedLogo${randomId}','imageInput${randomId}')" accept="image/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('videoInput${randomId}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/upload-icon-large.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedVideo${randomId}">Upload videos</div>
                                <input type="file" id="videoInput${randomId}" class="d-none" name="video[]"
                                    onchange="showFileName('selectedVideo${randomId}','videoInput${randomId}')" accept="video/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('fileInput${randomId}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/star-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedFile${randomId}">Upload 3D Object</div>
                                <input type="file" id="fileInput${randomId}" class="d-none" name="object[]"
                                    onchange="showFileName('selectedFile${randomId}','fileInput${randomId}')" />
                                <div class=""></div>
                            </div>
                        </div>
                `)
                keyId++;
                $('.select2').select2();
                $('.select2').css('width', '100%');
            });
        });
        $(document).ready(function() {
            $('.select2').select2();
            $('.select2').css('width', '100%');
        })
    </script>
@endpush
