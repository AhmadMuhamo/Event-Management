@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('edit') !!}</div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">Name</label>

                                <div class="col-md-3 col-xs-6">
                                    <input id="first_name" type="text" placeholder="First" class="form-control" name="first_name" value="{{ $user_det->first_name }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <input id="last_name" type="text" placeholder="Last" class="form-control" name="last_name" value="{{ $user_det->last_name }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="email" class="col-md-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-5 col-xs-8">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-3 col-xs-12 control-label">Gender</label>

                                <div class="col-md-6">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <select id="gender" class="form-control" name="gender">
                                            <option value="Unspecified" <?php if($user_det->gender=='Unspecified') echo 'selected' ?>></option>
                                            <option value="Female" <?php if($user_det->gender=='Female') echo 'selected' ?>>Female</option>
                                            <option value="Male" <?php if($user_det->gender=='Male') echo 'selected' ?>>Male</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-3 col-xs-12 control-label">Birthday</label>

                                <div class="col-md-4 col-xs-8">
                                    <input id="birthday" type="text" class="form-control" name="birthday" placeholder="dd-mm-yyyy" @if($user_det->birth_date==NULL)value="" @else value="{{date('d-m-Y', strtotime($user_det->birth_date))}}" @endif>
                                </div>
                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="primary_phone" class="col-md-3 col-xs-12 control-label">Primary Phone</label>

                                <div class="col-md-4 col-xs-8">
                                    <input id="primary_phone" type="text" class="form-control" name="primary_phone" placeholder="" value="{{$user_det->primary_phone}}" required autofocus>
                                </div>
                                @if ($errors->has('primary_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('primary_phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="other_phone" class="col-md-3 col-xs-12 control-label">Other Phone</label>

                                <div class="col-md-4 col-xs-8">
                                    <input id="other_phone" type="text" class="form-control" name="other_phone" value="{{$user_det->other_phone}}">
                                </div>
                                @if ($errors->has('other_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('other_phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="country" class="col-md-3 col-xs-12 control-label">Country</label>
                                <div class="col-md-5 col-xs-8">
                                    <select id="country" class="form-control" name="country">
                                        <option value="Afghanistan" <?php if($user_det->country=='Afghanistan') echo 'selected' ?>>Afghanistan</option>
                                        <option value="Åland Islands" <?php if($user_det->country=='Åland Islands') echo 'selected' ?>>Åland Islands</option>
                                        <option value="Albania" <?php if($user_det->country=='Albania') echo 'selected' ?>>Albania</option>
                                        <option value="Algeria" <?php if($user_det->country=='Algeria') echo 'selected' ?>>Algeria</option>
                                        <option value="American Samoa" <?php if($user_det->country=='American Samoa') echo 'selected' ?>>American Samoa</option>
                                        <option value="Andorra" <?php if($user_det->country=='Andorra') echo 'selected' ?>>Andorra</option>
                                        <option value="Angola" <?php if($user_det->country=='Angola') echo 'selected' ?>>Angola</option>
                                        <option value="Anguilla" <?php if($user_det->country=='Anguilla') echo 'selected' ?>>Anguilla</option>
                                        <option value="Antarctica" <?php if($user_det->country=='Antarctica') echo 'selected' ?>>Antarctica</option>
                                        <option value="Antigua and Barbuda" <?php if($user_det->country=='Antigua and Barbuda') echo 'selected' ?>>Antigua and Barbuda</option>
                                        <option value="Argentina" <?php if($user_det->country=='Argentina') echo 'selected' ?>>Argentina</option>
                                        <option value="Armenia" <?php if($user_det->country=='Armenia') echo 'selected' ?>>Armenia</option>
                                        <option value="Aruba" <?php if($user_det->country=='Aruba') echo 'selected' ?>>Aruba</option>
                                        <option value="Australia" <?php if($user_det->country=='Australia') echo 'selected' ?>>Australia</option>
                                        <option value="Austria" <?php if($user_det->country=='Austria') echo 'selected' ?>>Austria</option>
                                        <option value="Azerbaijan" <?php if($user_det->country=='Azerbaijan') echo 'selected' ?>>Azerbaijan</option>
                                        <option value="Bahamas" <?php if($user_det->country=='Bahamas') echo 'selected' ?>>Bahamas</option>
                                        <option value="Bahrain" <?php if($user_det->country=='Bahrain') echo 'selected' ?>>Bahrain</option>
                                        <option value="Bangladesh" <?php if($user_det->country=='Bangladesh') echo 'selected' ?>>Bangladesh</option>
                                        <option value="Barbados" <?php if($user_det->country=='Barbados') echo 'selected' ?>>Barbados</option>
                                        <option value="Belarus" <?php if($user_det->country=='Belarus') echo 'selected' ?>>Belarus</option>
                                        <option value="Belgium" <?php if($user_det->country=='Belgium') echo 'selected' ?>>Belgium</option>
                                        <option value="Belize" <?php if($user_det->country=='Belize') echo 'selected' ?>>Belize</option>
                                        <option value="Benin" <?php if($user_det->country=='Benin') echo 'selected' ?>>Benin</option>
                                        <option value="Bermuda" <?php if($user_det->country=='Bermuda') echo 'selected' ?>>Bermuda</option>
                                        <option value="Bhutan" <?php if($user_det->country=='Bhutan') echo 'selected' ?>>Bhutan</option>
                                        <option value="Bolivia, Plurinational State of" <?php if($user_det->country=='Bolivia, Plurinational State of') echo 'selected' ?>>Bolivia, Plurinational State of</option>
                                        <option value="Bonaire, Sint Eustatius and Saba" <?php if($user_det->country=='Bonaire, Sint Eustatius and Saba') echo 'selected' ?>>Bonaire, Sint Eustatius and Saba</option>
                                        <option value="Bosnia and Herzegovina" <?php if($user_det->country=='Bosnia and Herzegovina') echo 'selected' ?>>Bosnia and Herzegovina</option>
                                        <option value="Botswana" <?php if($user_det->country=='Botswana') echo 'selected' ?>>Botswana</option>
                                        <option value="Bouvet Island" <?php if($user_det->country=='Bouvet Island') echo 'selected' ?>>Bouvet Island</option>
                                        <option value="Brazil" <?php if($user_det->country=='Brazil') echo 'selected' ?>>Brazil</option>
                                        <option value="British Indian Ocean Territory" <?php if($user_det->country=='British Indian Ocean Territory') echo 'selected' ?>>British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam" <?php if($user_det->country=='Brunei Darussalam') echo 'selected' ?>>Brunei Darussalam</option>
                                        <option value="Bulgaria" <?php if($user_det->country=='Bulgaria') echo 'selected' ?>>Bulgaria</option>
                                        <option value="Burkina Faso" <?php if($user_det->country=='Burkina Faso') echo 'selected' ?>>Burkina Faso</option>
                                        <option value="Burundi" <?php if($user_det->country=='Burundi') echo 'selected' ?>>Burundi</option>
                                        <option value="Cambodia" <?php if($user_det->country=='Cambodia') echo 'selected' ?>>Cambodia</option>
                                        <option value="Cameroon" <?php if($user_det->country=='Cameroon') echo 'selected' ?>>Cameroon</option>
                                        <option value="Canada" <?php if($user_det->country=='Canada') echo 'selected' ?>>Canada</option>
                                        <option value="Cape Verde" <?php if($user_det->country=='Cape Verde') echo 'selected' ?>>Cape Verde</option>
                                        <option value="Cayman Islands" <?php if($user_det->country=='Cayman Islands') echo 'selected' ?>>Cayman Islands</option>
                                        <option value="Central African Republic" <?php if($user_det->country=='Central African Republic') echo 'selected' ?>>Central African Republic</option>
                                        <option value="Chad" <?php if($user_det->country=='Chad') echo 'selected' ?>>Chad</option>
                                        <option value="Chile" <?php if($user_det->country=='Chile') echo 'selected' ?>>Chile</option>
                                        <option value="China" <?php if($user_det->country=='China') echo 'selected' ?>>China</option>
                                        <option value="Christmas Island" <?php if($user_det->country=='Christmas Island') echo 'selected' ?>>Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands" <?php if($user_det->country=='Cocos (Keeling) Islands') echo 'selected' ?>>Cocos (Keeling) Islands</option>
                                        <option value="Colombia" <?php if($user_det->country=='Colombia') echo 'selected' ?>>Colombia</option>
                                        <option value="Comoros" <?php if($user_det->country=='Comoros') echo 'selected' ?>>Comoros</option>
                                        <option value="Congo" <?php if($user_det->country=='Congo') echo 'selected' ?>>Congo</option>
                                        <option value="Congo, the Democratic Republic of the" <?php if($user_det->country=='Congo, the Democratic Republic of the') echo 'selected' ?>>Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands" <?php if($user_det->country=='Cook Islands') echo 'selected' ?>>Cook Islands</option>
                                        <option value="Costa Rica" <?php if($user_det->country=='Costa Rica') echo 'selected' ?>>Costa Rica</option>
                                        <option value="Côte d'Ivoire" <?php if($user_det->country=='Côte d\'Ivoire') echo 'selected' ?>>Côte d'Ivoire</option>
                                        <option value="Croatia" <?php if($user_det->country=='Croatia') echo 'selected' ?>>Croatia</option>
                                        <option value="Cuba" <?php if($user_det->country=='Cuba') echo 'selected' ?>>Cuba</option>
                                        <option value="Curaçao" <?php if($user_det->country=='Curaçao') echo 'selected' ?>>Curaçao</option>
                                        <option value="Cyprus" <?php if($user_det->country=='Cyprus') echo 'selected' ?>>Cyprus</option>
                                        <option value="Czech Republic" <?php if($user_det->country=='Czech Republic') echo 'selected' ?>>Czech Republic</option>
                                        <option value="Denmark" <?php if($user_det->country=='Denmark') echo 'selected' ?>>Denmark</option>
                                        <option value="Djibouti" <?php if($user_det->country=='Djibouti') echo 'selected' ?>>Djibouti</option>
                                        <option value="Dominica" <?php if($user_det->country=='Dominica') echo 'selected' ?>>Dominica</option>
                                        <option value="Dominican Republic" <?php if($user_det->country=='Dominican Republic') echo 'selected' ?>>Dominican Republic</option>
                                        <option value="Ecuador" <?php if($user_det->country=='Ecuador') echo 'selected' ?>>Ecuador</option>
                                        <option value="Egypt" <?php if($user_det->country=='Egypt') echo 'selected' ?>>Egypt</option>
                                        <option value="El Salvador" <?php if($user_det->country=='El Salvador') echo 'selected' ?>>El Salvador</option>
                                        <option value="Equatorial Guinea" <?php if($user_det->country=='Equatorial Guinea') echo 'selected' ?>>Equatorial Guinea</option>
                                        <option value="Eritrea" <?php if($user_det->country=='Eritrea') echo 'selected' ?>>Eritrea</option>
                                        <option value="Estonia" <?php if($user_det->country=='Estonia') echo 'selected' ?>>Estonia</option>
                                        <option value="Ethiopia" <?php if($user_det->country=='Ethiopia') echo 'selected' ?>>Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)" <?php if($user_det->country=='Falkland Islands (Malvinas)') echo 'selected' ?>>Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands" <?php if($user_det->country=='Faroe Islands') echo 'selected' ?>>Faroe Islands</option>
                                        <option value="Fiji" <?php if($user_det->country=='Fiji') echo 'selected' ?>>Fiji</option>
                                        <option value="Finland" <?php if($user_det->country=='Finland') echo 'selected' ?>>Finland</option>
                                        <option value="France" <?php if($user_det->country=='France') echo 'selected' ?>>France</option>
                                        <option value="French Guiana" <?php if($user_det->country=='French Guiana') echo 'selected' ?>>French Guiana</option>
                                        <option value="French Polynesia" <?php if($user_det->country=='French Polynesia') echo 'selected' ?>>French Polynesia</option>
                                        <option value="French Southern Territories" <?php if($user_det->country=='French Southern Territories') echo 'selected' ?>>French Southern Territories</option>
                                        <option value="Gabon" <?php if($user_det->country=='Gabon') echo 'selected' ?>>Gabon</option>
                                        <option value="Gambia" <?php if($user_det->country=='Gambia') echo 'selected' ?>>Gambia</option>
                                        <option value="Georgia" <?php if($user_det->country=='Georgia') echo 'selected' ?>>Georgia</option>
                                        <option value="Germany" <?php if($user_det->country=='Germany') echo 'selected' ?>>Germany</option>
                                        <option value="Ghana" <?php if($user_det->country=='Ghana') echo 'selected' ?>>Ghana</option>
                                        <option value="Gibraltar" <?php if($user_det->country=='Gibraltar') echo 'selected' ?>>Gibraltar</option>
                                        <option value="Greece" <?php if($user_det->country=='Greece') echo 'selected' ?>>Greece</option>
                                        <option value="Greenland" <?php if($user_det->country=='Greenland') echo 'selected' ?>>Greenland</option>
                                        <option value="Grenada" <?php if($user_det->country=='Grenada') echo 'selected' ?>>Grenada</option>
                                        <option value="Guadeloupe" <?php if($user_det->country=='Guadeloupe') echo 'selected' ?>>Guadeloupe</option>
                                        <option value="Guam" <?php if($user_det->country=='Guam') echo 'selected' ?>>Guam</option>
                                        <option value="Guatemala" <?php if($user_det->country=='Guatemala') echo 'selected' ?>>Guatemala</option>
                                        <option value="Guernsey" <?php if($user_det->country=='Guernsey') echo 'selected' ?>>Guernsey</option>
                                        <option value="Guinea" <?php if($user_det->country=='Guinea') echo 'selected' ?>>Guinea</option>
                                        <option value="Guinea-Bissau" <?php if($user_det->country=='Guinea-Bissau') echo 'selected' ?>>Guinea-Bissau</option>
                                        <option value="Guyana" <?php if($user_det->country=='Guyana') echo 'selected' ?>>Guyana</option>
                                        <option value="Haiti" <?php if($user_det->country=='Haiti') echo 'selected' ?>>Haiti</option>
                                        <option value="Heard Island and McDonald Islands" <?php if($user_det->country=='Heard Island and McDonald Islands') echo 'selected' ?>>Heard Island and McDonald Islands</option>
                                        <option value="Holy See (Vatican City State)" <?php if($user_det->country=='Holy See (Vatican City State)') echo 'selected' ?>>Holy See (Vatican City State)</option>
                                        <option value="Honduras" <?php if($user_det->country=='Honduras') echo 'selected' ?>>Honduras</option>
                                        <option value="Hong Kong" <?php if($user_det->country=='Hong Kong') echo 'selected' ?>>Hong Kong</option>
                                        <option value="Hungary" <?php if($user_det->country=='Hungary') echo 'selected' ?>>Hungary</option>
                                        <option value="Iceland" <?php if($user_det->country=='Iceland') echo 'selected' ?>>Iceland</option>
                                        <option value="India" <?php if($user_det->country=='India') echo 'selected' ?>>India</option>
                                        <option value="Indonesia" <?php if($user_det->country=='Indonesia') echo 'selected' ?>>Indonesia</option>
                                        <option value="Iran, Islamic Republic of" <?php if($user_det->country=='Iran, Islamic Republic of') echo 'selected' ?>>Iran, Islamic Republic of</option>
                                        <option value="Iraq" <?php if($user_det->country=='Iraq') echo 'selected' ?>>Iraq</option>
                                        <option value="Ireland" <?php if($user_det->country=='Ireland') echo 'selected' ?>>Ireland</option>
                                        <option value="Isle of Man" <?php if($user_det->country=='Isle of Man') echo 'selected' ?>>Isle of Man</option>
                                        <option value="Israel" <?php if($user_det->country=='Israel') echo 'selected' ?>>Israel</option>
                                        <option value="Italy" <?php if($user_det->country=='Italy') echo 'selected' ?>>Italy</option>
                                        <option value="Jamaica" <?php if($user_det->country=='Jamaica') echo 'selected' ?>>Jamaica</option>
                                        <option value="Japan" <?php if($user_det->country=='Japan') echo 'selected' ?>>Japan</option>
                                        <option value="Jersey" <?php if($user_det->country=='Jersey') echo 'selected' ?>>Jersey</option>
                                        <option value="Jordan" <?php if($user_det->country=='Jordan') echo 'selected' ?>>Jordan</option>
                                        <option value="Kazakhstan" <?php if($user_det->country=='Kazakhstan') echo 'selected' ?>>Kazakhstan</option>
                                        <option value="Kenya" <?php if($user_det->country=='Kenya') echo 'selected' ?>>Kenya</option>
                                        <option value="Kiribati" <?php if($user_det->country=='Kiribati') echo 'selected' ?>>Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of" <?php if($user_det->country=='Korea, Democratic People\'s Republic of') echo 'selected' ?>>Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of" <?php if($user_det->country=='Korea, Republic of') echo 'selected' ?>>Korea, Republic of</option>
                                        <option value="Kuwait" <?php if($user_det->country=='Kuwait') echo 'selected' ?>>Kuwait</option>
                                        <option value="Kyrgyzstan" <?php if($user_det->country=='Kyrgyzstan') echo 'selected' ?>>Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic" <?php if($user_det->country=='Lao People\'s Democratic Republic') echo 'selected' ?>>Lao People's Democratic Republic</option>
                                        <option value="Latvia" <?php if($user_det->country=='Latvia') echo 'selected' ?>>Latvia</option>
                                        <option value="Lebanon" <?php if($user_det->country=='Lebanon') echo 'selected' ?>>Lebanon</option>
                                        <option value="Lesotho" <?php if($user_det->country=='Lesotho') echo 'selected' ?>>Lesotho</option>
                                        <option value="Liberia" <?php if($user_det->country=='Liberia') echo 'selected' ?>>Liberia</option>
                                        <option value="Libya" <?php if($user_det->country=='Libya') echo 'selected' ?>>Libya</option>
                                        <option value="Liechtenstein" <?php if($user_det->country=='Liechtenstein') echo 'selected' ?>>Liechtenstein</option>
                                        <option value="Lithuania" <?php if($user_det->country=='Lithuania') echo 'selected' ?>>Lithuania</option>
                                        <option value="Luxembourg" <?php if($user_det->country=='Luxembourg') echo 'selected' ?>>Luxembourg</option>
                                        <option value="Macao" <?php if($user_det->country=='Macao') echo 'selected' ?>>Macao</option>
                                        <option value="Macedonia, the former Yugoslav Republic of" <?php if($user_det->country=='Macedonia, the former Yugoslav Republic of') echo 'selected' ?>>Macedonia, the former Yugoslav Republic of</option>
                                        <option value="Madagascar" <?php if($user_det->country=='Madagascar') echo 'selected' ?>>Madagascar</option>
                                        <option value="Malawi" <?php if($user_det->country=='Malawi') echo 'selected' ?>>Malawi</option>
                                        <option value="Malaysia" <?php if($user_det->country=='Malaysia') echo 'selected' ?>>Malaysia</option>
                                        <option value="Maldives" <?php if($user_det->country=='Maldives') echo 'selected' ?>>Maldives</option>
                                        <option value="Mali" <?php if($user_det->country=='Mali') echo 'selected' ?>>Mali</option>
                                        <option value="Malta" <?php if($user_det->country=='Malta') echo 'selected' ?>>Malta</option>
                                        <option value="Marshall Islands" <?php if($user_det->country=='Marshall Islands') echo 'selected' ?>>Marshall Islands</option>
                                        <option value="Martinique" <?php if($user_det->country=='Martinique') echo 'selected' ?>>Martinique</option>
                                        <option value="Mauritania" <?php if($user_det->country=='Mauritania') echo 'selected' ?>>Mauritania</option>
                                        <option value="Mauritius" <?php if($user_det->country=='Mauritius') echo 'selected' ?>>Mauritius</option>
                                        <option value="Mayotte" <?php if($user_det->country=='Mayotte') echo 'selected' ?>>Mayotte</option>
                                        <option value="Mexico" <?php if($user_det->country=='Mexico') echo 'selected' ?>>Mexico</option>
                                        <option value="Micronesia, Federated States of" <?php if($user_det->country=='Micronesia, Federated States of') echo 'selected' ?>>Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of" <?php if($user_det->country=='Moldova, Republic of') echo 'selected' ?>>Moldova, Republic of</option>
                                        <option value="Monaco" <?php if($user_det->country=='Monaco') echo 'selected' ?>>Monaco</option>
                                        <option value="Mongolia" <?php if($user_det->country=='Mongolia') echo 'selected' ?>>Mongolia</option>
                                        <option value="Montenegro" <?php if($user_det->country=='Montenegro') echo 'selected' ?>>Montenegro</option>
                                        <option value="Montserrat" <?php if($user_det->country=='Montserrat') echo 'selected' ?>>Montserrat</option>
                                        <option value="Morocco" <?php if($user_det->country=='Morocco') echo 'selected' ?>>Morocco</option>
                                        <option value="Mozambique" <?php if($user_det->country=='Mozambique') echo 'selected' ?>>Mozambique</option>
                                        <option value="Myanmar" <?php if($user_det->country=='Myanmar') echo 'selected' ?>>Myanmar</option>
                                        <option value="Namibia" <?php if($user_det->country=='Namibia') echo 'selected' ?>>Namibia</option>
                                        <option value="Nauru" <?php if($user_det->country=='Nauru') echo 'selected' ?>>Nauru</option>
                                        <option value="Nepal" <?php if($user_det->country=='Nepal') echo 'selected' ?>>Nepal</option>
                                        <option value="Netherlands" <?php if($user_det->country=='Netherlands') echo 'selected' ?>>Netherlands</option>
                                        <option value="New Caledonia" <?php if($user_det->country=='New Caledonia') echo 'selected' ?>>New Caledonia</option>
                                        <option value="New Zealand" <?php if($user_det->country=='New Zealand') echo 'selected' ?>>New Zealand</option>
                                        <option value="Nicaragua" <?php if($user_det->country=='Nicaragua') echo 'selected' ?>>Nicaragua</option>
                                        <option value="Niger" <?php if($user_det->country=='Niger') echo 'selected' ?>>Niger</option>
                                        <option value="Nigeria" <?php if($user_det->country=='Nigeria') echo 'selected' ?>>Nigeria</option>
                                        <option value="Niue" <?php if($user_det->country=='Niue') echo 'selected' ?>>Niue</option>
                                        <option value="Norfolk Island" <?php if($user_det->country=='Norfolk Island') echo 'selected' ?>>Norfolk Island</option>
                                        <option value="Northern Mariana Islands" <?php if($user_det->country=='Northern Mariana Islands') echo 'selected' ?>>Northern Mariana Islands</option>
                                        <option value="Norway" <?php if($user_det->country=='Norway') echo 'selected' ?>>Norway</option>
                                        <option value="Oman" <?php if($user_det->country=='Oman') echo 'selected' ?>>Oman</option>
                                        <option value="Pakistan" <?php if($user_det->country=='Pakistan') echo 'selected' ?>>Pakistan</option>
                                        <option value="Palau" <?php if($user_det->country=='Palau') echo 'selected' ?>>Palau</option>
                                        <option value="Palestinian Territory, Occupied" <?php if($user_det->country=='Palestinian Territory, Occupied') echo 'selected' ?>>Palestinian Territory, Occupied</option>
                                        <option value="Panama" <?php if($user_det->country=='Panama') echo 'selected' ?>>Panama</option>
                                        <option value="Papua New Guinea" <?php if($user_det->country=='Papua New Guinea') echo 'selected' ?>>Papua New Guinea</option>
                                        <option value="Paraguay" <?php if($user_det->country=='Paraguay') echo 'selected' ?>>Paraguay</option>
                                        <option value="Peru" <?php if($user_det->country=='Peru') echo 'selected' ?>>Peru</option>
                                        <option value="Philippines" <?php if($user_det->country=='Philippines') echo 'selected' ?>>Philippines</option>
                                        <option value="Pitcairn" <?php if($user_det->country=='Pitcairn') echo 'selected' ?>>Pitcairn</option>
                                        <option value="Poland" <?php if($user_det->country=='Poland') echo 'selected' ?>>Poland</option>
                                        <option value="Portugal" <?php if($user_det->country=='Portugal') echo 'selected' ?>>Portugal</option>
                                        <option value="Puerto Rico" <?php if($user_det->country=='Puerto Rico') echo 'selected' ?>>Puerto Rico</option>
                                        <option value="Qatar" <?php if($user_det->country=='Qatar') echo 'selected' ?>>Qatar</option>
                                        <option value="Réunion" <?php if($user_det->country=='Réunion') echo 'selected' ?>>Réunion</option>
                                        <option value="Romania" <?php if($user_det->country=='Romania') echo 'selected' ?>>Romania</option>
                                        <option value="Russian Federation" <?php if($user_det->country=='Russian Federation') echo 'selected' ?>>Russian Federation</option>
                                        <option value="Rwanda" <?php if($user_det->country=='Rwanda') echo 'selected' ?>>Rwanda</option>
                                        <option value="Saint Barthélemy" <?php if($user_det->country=='Saint Barthélemy') echo 'selected' ?>>Saint Barthélemy</option>
                                        <option value="Saint Helena, Ascension and Tristan da Cunha" <?php if($user_det->country=='Saint Helena, Ascension and Tristan da Cunha') echo 'selected' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="Saint Kitts and Nevis" <?php if($user_det->country=='Saint Kitts and Nevis') echo 'selected' ?>>Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" <?php if($user_det->country=='Saint Lucia') echo 'selected' ?>>Saint Lucia</option>
                                        <option value="Saint Martin (French part)" <?php if($user_det->country=='Saint Martin (French part)') echo 'selected' ?>>Saint Martin (French part)</option>
                                        <option value="Saint Pierre and Miquelon" <?php if($user_det->country=='Saint Pierre and Miquelon') echo 'selected' ?>>Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and the Grenadines" <?php if($user_det->country=='Saint Vincent and the Grenadines') echo 'selected' ?>>Saint Vincent and the Grenadines</option>
                                        <option value="Samoa" <?php if($user_det->country=='Samoa') echo 'selected' ?>>Samoa</option>
                                        <option value="San Marino" <?php if($user_det->country=='San Marino') echo 'selected' ?>>San Marino</option>
                                        <option value="Sao Tome and Principe" <?php if($user_det->country=='Sao Tome and Principe') echo 'selected' ?>>Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" <?php if($user_det->country=='Saudi Arabia') echo 'selected' ?>>Saudi Arabia</option>
                                        <option value="Senegal" <?php if($user_det->country=='Senegal') echo 'selected' ?>>Senegal</option>
                                        <option value="Serbia" <?php if($user_det->country=='Serbia') echo 'selected' ?>>Serbia</option>
                                        <option value="Seychelles" <?php if($user_det->country=='Seychelles') echo 'selected' ?>>Seychelles</option>
                                        <option value="Sierra Leone" <?php if($user_det->country=='Sierra Leone') echo 'selected' ?>>Sierra Leone</option>
                                        <option value="Singapore" <?php if($user_det->country=='Singapore') echo 'selected' ?>>Singapore</option>
                                        <option value="Sint Maarten (Dutch part)" <?php if($user_det->country=='Sint Maarten (Dutch part)') echo 'selected' ?>>Sint Maarten (Dutch part)</option>
                                        <option value="Slovakia" <?php if($user_det->country=='Slovakia') echo 'selected' ?>>Slovakia</option>
                                        <option value="Slovenia" <?php if($user_det->country=='Slovenia') echo 'selected' ?>>Slovenia</option>
                                        <option value="Solomon Islands" <?php if($user_det->country=='Solomon Islands') echo 'selected' ?>>Solomon Islands</option>
                                        <option value="Somalia" <?php if($user_det->country=='Somalia') echo 'selected' ?>>Somalia</option>
                                        <option value="South Africa" <?php if($user_det->country=='South Africa') echo 'selected' ?>>South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands" <?php if($user_det->country=='South Georgia and the South Sandwich Islands') echo 'selected' ?>>South Georgia and the South Sandwich Islands</option>
                                        <option value="South Sudan" <?php if($user_det->country=='South Sudan') echo 'selected' ?>>South Sudan</option>
                                        <option value="Spain" <?php if($user_det->country=='Spain') echo 'selected' ?>>Spain</option>
                                        <option value="Sri Lanka" <?php if($user_det->country=='Sri Lanka') echo 'selected' ?>>Sri Lanka</option>
                                        <option value="Sudan" <?php if($user_det->country=='Sudan') echo 'selected' ?>>Sudan</option>
                                        <option value="Suriname" <?php if($user_det->country=='Suriname') echo 'selected' ?>>Suriname</option>
                                        <option value="Svalbard and Jan Mayen" <?php if($user_det->country=='Svalbard and Jan Mayen') echo 'selected' ?>>Svalbard and Jan Mayen</option>
                                        <option value="Swaziland" <?php if($user_det->country=='Swaziland') echo 'selected' ?>>Swaziland</option>
                                        <option value="Sweden" <?php if($user_det->country=='Sweden') echo 'selected' ?>>Sweden</option>
                                        <option value="Switzerland" <?php if($user_det->country=='Switzerland') echo 'selected' ?>>Switzerland</option>
                                        <option value="Syrian Arab Republic" <?php if($user_det->country=='Syrian Arab Republic') echo 'selected' ?>>Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China" <?php if($user_det->country=='Taiwan, Province of China') echo 'selected' ?>>Taiwan, Province of China</option>
                                        <option value="Tajikistan" <?php if($user_det->country=='Tajikistan') echo 'selected' ?>>Tajikistan</option>
                                        <option value="Tanzania, United Republic of" <?php if($user_det->country=='Tanzania, United Republic of') echo 'selected' ?>>Tanzania, United Republic of</option>
                                        <option value="Thailand" <?php if($user_det->country=='Thailand') echo 'selected' ?>>Thailand</option>
                                        <option value="Timor-Leste" <?php if($user_det->country=='Timor-Leste') echo 'selected' ?>>Timor-Leste</option>
                                        <option value="Togo" <?php if($user_det->country=='Togo') echo 'selected' ?>>Togo</option>
                                        <option value="Tokelau" <?php if($user_det->country=='Tokelau') echo 'selected' ?>>Tokelau</option>
                                        <option value="Tonga" <?php if($user_det->country=='Tonga') echo 'selected' ?>>Tonga</option>
                                        <option value="Trinidad and Tobago" <?php if($user_det->country=='Trinidad and Tobago') echo 'selected' ?>>Trinidad and Tobago</option>
                                        <option value="Tunisia" <?php if($user_det->country=='Tunisia') echo 'selected' ?>>Tunisia</option>
                                        <option value="Turkey" <?php if($user_det->country=='Turkey') echo 'selected' ?>>Turkey</option>
                                        <option value="Turkmenistan" <?php if($user_det->country=='Turkmenistan') echo 'selected' ?>>Turkmenistan</option>
                                        <option value="Turks and Caicos Islands" <?php if($user_det->country=='Turks and Caicos Islands') echo 'selected' ?>>Turks and Caicos Islands</option>
                                        <option value="Tuvalu" <?php if($user_det->country=='Tuvalu') echo 'selected' ?>>Tuvalu</option>
                                        <option value="Uganda" <?php if($user_det->country=='Uganda') echo 'selected' ?>>Uganda</option>
                                        <option value="Ukraine" <?php if($user_det->country=='Ukraine') echo 'selected' ?>>Ukraine</option>
                                        <option value="United Arab Emirates" <?php if($user_det->country=='United Arab Emirates') echo 'selected' ?>>United Arab Emirates</option>
                                        <option value="United Kingdom" <?php if($user_det->country=='United Kingdom') echo 'selected' ?>>United Kingdom</option>
                                        <option value="United States" <?php if($user_det->country=='United States') echo 'selected' ?>>United States</option>
                                        <option value="United States Minor Outlying Islands" <?php if($user_det->country=='United States Minor Outlying Islands') echo 'selected' ?>>United States Minor Outlying Islands</option>
                                        <option value="Uruguay" <?php if($user_det->country=='Uruguay') echo 'selected' ?>>Uruguay</option>
                                        <option value="Uzbekistan" <?php if($user_det->country=='Uzbekistan') echo 'selected' ?>>Uzbekistan</option>
                                        <option value="Vanuatu" <?php if($user_det->country=='Vanuatu') echo 'selected' ?>>Vanuatu</option>
                                        <option value="Venezuela, Bolivarian Republic of" <?php if($user_det->country=='Venezuela, Bolivarian Republic of') echo 'selected' ?>>Venezuela, Bolivarian Republic of</option>
                                        <option value="Viet Nam" <?php if($user_det->country=='Viet Nam') echo 'selected' ?>>Viet Nam</option>
                                        <option value="Virgin Islands, British" <?php if($user_det->country=='Virgin Islands, British') echo 'selected' ?>>Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S." <?php if($user_det->country=='Virgin Islands, U.S.') echo 'selected' ?>>Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna" <?php if($user_det->country=='Wallis and Futuna') echo 'selected' ?>>Wallis and Futuna</option>
                                        <option value="Western Sahara <?php if($user_det->country=='Western Sahara') echo 'selected' ?>">Western Sahara</option>
                                        <option value="Yemen" <?php if($user_det->country=='Yemen') echo 'selected' ?>>Yemen</option>
                                        <option value="Zambia" <?php if($user_det->country=='Zambia') echo 'selected' ?>>Zambia</option>
                                        <option value="Zimbabwe" <?php if($user_det->country=='Zimbabwe') echo 'selected' ?>>Zimbabwe</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="city" class="col-md-3 col-xs-12 control-label">City</label>
                                <div class="col-md-2">
                                    <input id="city" type="text" class="form-control" name="city" value="{{$user_det->city}}">
                                </div>

                                <label for="postal_code" class="col-md-2 control-label">Postal Code</label>

                                <div class="col-md-2">
                                    <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{$user_det->postal_code}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-3 col-xs-12 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{$user_det->address}}" placeholder=" Line 1">
                                </div>
                            </div>
                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="address_line2" class="col-md-3 col-xs-12 control-label"></label>
                                <div class="col-md-6">
                                    <input id="address_line2" type="text" class="form-control" name="address_line2" value="{{$user_det->address_line2}}" placeholder=" Line 2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="billing_address" class="col-md-3 col-xs-12 control-label">Billing Address</label>

                                <div class="col-md-6">
                                    <input id="billing_address" type="text" class="form-control" name="billing_address" value="{{$user_det->billing_address}}" placeholder=" Line 1">
                                </div>
                            </div>
                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="billing_address_line2" class="col-md-3 col-xs-12 control-label"></label>
                                <div class="col-md-6">
                                    <input id="billing_address_line2" type="text" class="form-control" name="billing_address_line2" value="{{$user_det->billing_address_line2}}" placeholder=" Line 2">
                                </div>
                            </div>

                            <div class="form-group">
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
