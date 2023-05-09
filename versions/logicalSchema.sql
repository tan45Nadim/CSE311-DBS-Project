create table patient (
    p_id int auto_increment,
    p_name varchar(30),
    p_age smallint,
    p_sex varchar(1),
    mobile_no varchar(15),
    address varchar(40),
    isResident varchar(1),
    room_no varchar(10),
    primary key (p_id),
    check (isResident = '0' or isResident = '1'),
    check (p_sex = 'F' or p_sex = 'M')
);

create table purpose (
    purpose_id varchar(7),
    purpose_name varchar(30),
    dept_init varchar(20),
    primary key (purpose_id)
);

create table doctor (
    dr_init varchar(7),
    dr_name varchar(30),
    dept_init varchar(20),
    room_no varchar(10),
    primary key (dr_init)
);

create table department (
    dept_init varchar(20),
    dept_name varchar(30),
    room_no varchar(10),
    dept_head_init varchar(7),
    primary key (dept_init)
);

create table hospital_room (
    room_no varchar(10),
    isAvailable varchar(1),
    primary key (room_no),
    check (isAvailable = '0' or isAvailable = '1')
);

create table payment_history (
    visit_count smallint,
    p_id int,
    purpose_id varchar(7),
    payable_amount mediumint,
    paid mediumint,
    admission_date date,
    release_date date,
    assign_dr_init varchar(7),
    note Varchar(120),
    discount_pct smallint,
    primary key (p_id, visit_count),
    check (discount_pct >= 0 and discount_pct <= 100)
);

create table patient_record (
    visit_count smallint,
    p_id int,
    history varchar(30),
    time_count smallint
);

create table charge_sheet (
    charge_num varchar(30),
    charge_name varchar(30),
    amount mediumint,
    primary key (charge_num)
);

create table panel (
    username varchar(20),
    pass_word varchar(30),
    role varchar(10),
    primary key (username)
);

-- patient 
alter table patient
add foreign key (room_no)
references hospital_room(room_no) on delete set null;

-- purpose
alter table purpose
add foreign key (dept_init)
references department(dept_init) on delete set null;

-- doctor
alter table doctor
add foreign key (dept_init)
references department(dept_init) on delete set null;

alter table doctor
add foreign key (room_no)
references hospital_room(room_no) on delete set null;

-- department
alter table department
add foreign key (room_no)
references hospital_room(room_no) on delete set null;

alter table department
add foreign key (dept_head_init)
references doctor(dr_init) on delete set null;

-- Payment_history
alter table payment_history
add foreign key (p_id)
references patient(p_id) on delete cascade;

alter table payment_history
add foreign key (purpose_id)
references purpose(purpose_id);

alter table payment_history
add foreign key (assign_dr_init)
references doctor(dr_init) on delete set null;

-- patient_record
alter table patient_record
add foreign key (p_id, visit_count)
references payment_history(p_id, visit_count) on delete cascade;

alter table patient_record
add foreign key (history)
references charge_sheet(charge_num);

insert into hospital_room values
    ('NB101', '0'), ('NB102', '0'), ('NB103', '1'), ('NB104', '1'),
    ('NB201', '1'), ('NB202', '1'), ('NB203', '0'), ('NB204', '1'),
    ('NB301', '0'), ('NB302', '1'), ('NB303', '1'), ('NB304', '1'), 
    ('NB401', '0'), ('NB402', '0'), ('NB403', '0'), ('NB404', '1'),
    ('NB501', '1'), ('NB502', '1'), ('NB503', '1'), ('NB504', '1'),
    ('SB101', '0'), ('SB102', '0'), ('SB103', '0'), ('SB104', '0'), ('SB105', '1'),
    ('SB201', '0'), ('SB202', '1'), ('SB203', '0'), ('SB204', '1'), ('SB205', '0'), 
    ('SB301', '1'), ('SB302', '1'), ('SB303', '1'), ('SB304', '1'), ('SB305', '1'),
    ('DR101', '1'), ('DR102', '0'), ('DR103', '1'), ('DR104', '0'), ('DR105', '0'),
    ('DR201', '0'), ('DR202', '0'), ('DR203', '0'), ('DR204', '1'), ('DR205', '0'),
    ('DR301', '0'), ('DR302', '0'), ('DR303', '0'), ('DR304', '1'), ('DR305', '0'),
    ('DR401', '0'), ('DR402', '1'), ('DR403', '0'), ('DR404', '0'), ('DR405', '0'),
    ('DR501', '0'), ('DR502', '0'), ('DR503', '1'), ('DR504', '1'), ('DR505', '1'),
    ('AD01', '0'), ('AD02', '0'), ('AD03', '0'), ('AD04', '1'),
    ('AD05', '1'), ('AD06', '0'), ('AD07', '0'), ('AD08', '1');
    
alter table patient auto_increment = 1001;

insert into patient(p_name, p_age, p_sex, mobile_no, address, isResident, room_no) values 
    ('Adiba Rahman', '24', 'F', '0191491929', 'Badda', '0', NULL),
    ('Maha Bakhtiar', '45', 'F', '0183654128', 'Mohakhali DOHS', '0', NULL),
    ('Hasan Ali', '63', 'M', '0184454612', 'Bashundhara Ra', '0', NULL),
    ('Anova Fairuz', '13', 'F', '0173214561', 'Mirpur, DOHS', '0', NULL),
    ('Md. Rayhan Uddin', '67', 'M', '0180121413', 'Mohakhali DOHS', '1', 'NB101'),
    ('Rony Talukdar', '43', 'M', '0171415161', 'Keraniganj', '0', NULL),
    ('Adiba Sarkar', '24', 'F', '0153551515', 'Baridhara DOHS', '1', 'NB102'),
    ('Rifad Shawon', '23', 'M', '0161395123', 'Dhanmondi', '0', NULL),
    ('Afroz Farhana', '33', 'F', '0190123456', 'Gazipur', '0', NULL),
    ('Sumit Bishwas', '45', 'M', '0155015461', 'Madaripur', '1', 'NB203'),
    ('Habibur Rahman', '32', 'M', '0150001112', 'Gazipur', '1', 'NB301'),
    ('Shaikot Ali', '83', 'M', '0188776644', 'Board Bazar, Gazipur', '1', 'NB401'),
    ('Sohan Ferdous', '25', 'F', '0161395119', 'Bashundhara Ra', '1', 'NB402'),
    ('Jorina Akther', '35', 'F', '0199551515', 'Badda', '1', 'NB403'),
    ('Jafor Iqbal', '56', 'M', '0191448749', 'Bashundhara Ra', '0', NULL),
    ('Harun Ahmed', '24', 'M', '0161929394', 'Badda', '1', 'SB102'),
    ('Moloy Das', '22', 'M', '0187546531', 'Bashundhara Ra', '0', NULL),
    ('Jahangir Hasan', '18', 'M', '0165849453', 'Mirpur, DOHS', '0', NULL),
    ('Shakib Abdullah', '69', 'M', '0198714732', 'Badda', '0', NULL),
    ('Tonmoy Biswash', '69', 'M', '0173554515', 'Keraniganj', '1', 'SB101'),
    ('Md. Mahtab Khan', '77', 'M', '0155436541', 'Dhanmondi', '1', 'SB103'),
    ('Siam Ashraf', '44', 'M', '0165421349', 'Mirpur - 1', '0', NULL),
    ('Nokib Hasan', '32', 'M', '0123544515', 'Mirpur, Dhaka', '0', NULL),
    ('Sumona Rahman', '55', 'F', '0151239634', 'Badda', '1', 'SB104'),
    ('Sheila Hasan', '66', 'F', '0193265981', 'Dhanmondi 32', '1', 'SB201'),
    ('Ar Ataur Rahman', '72', 'M', '0179871472', 'Kafrul', '0', NULL),
    ('Imam Uddin', '17', 'M', '0161234567', 'Mirpur - 1', '0', NULL),
    ('Zakir Hasan', '05', 'M', '0153457854', 'Khilgaon', '0', NULL),
    ('Ziaul Alam', '82', 'M', '0190551915', 'Badda', '1', 'SB203'),
    ('Farisha Bahar', '08', 'F', '0187654321', 'Mirpur - 10', '1', 'SB205');
    
    
insert into department values
    ('GenM', 'General & Medicine', 'AD01', NULL),
    ('MomC', 'Mother & Child', 'AD02', NULL),
    ('Srgr', 'Surgery', 'AD03', NULL),
    ('Emrg', 'Emergency', 'AD06', NULL),
    ('Dgns', 'Diagnostic & Report', 'AD07', NULL);
    
    
insert into doctor values
    ('DvS', 'Dr. Devi Shetty (Cardio)', 'Srgr', 'DR501'),
    ('AhN', 'Dr. Ahmed Nasser (Ortho)', 'Srgr', 'DR202'),
    ('TrH', 'Dr. Tanvir Hasan (Gen)', 'Srgr', 'DR404'),
    ('ZdS', 'Dr. Zahed Saleh (Skin)', 'Srgr', 'DR201'),
    ('SsN', 'Dr. Samsun Nahar (Gyn)', 'MomC', 'DR401'),
    ('AbD', 'Dr. Abid Hassan (Child)', 'MomC', 'DR301'),
    ('ACh', 'Dr. Ashfia Chowdhury (Gyn)', 'MomC', 'DR302'),
    ('OKr', 'Dr. Opi Karim (Dial)', 'Dgns', 'DR203'),
    ('FZn', 'Dr. Farzana Akter (Path)', 'Dgns', 'DR403'),
    ('MKr', 'Dr. Moloy Kumar (Cardio)', 'GenM', 'DR305'),
    ('NHq', 'Dr. Nafis Haque (Cons)', 'GenM', 'DR205'),
    ('FzM', 'Dr. Faraz Malik (Med)', 'GenM', 'DR502'),
    ('HsM', 'Dr. Hasan Masud (H&N)', 'GenM', 'DR405'),
    ('NiS2', 'Dr. Niloy Sen (Psy)', 'GenM', 'DR102'),
    ('AKr', 'Dr. Ahmed Kabir (ENT)', 'GenM', 'DR104'),
    ('HRd', 'Dr. Harun Or Rashid (247)', 'Emrg', 'DR105'),
    ('NiS', 'Dr. Niloy Sen (247)', 'Emrg', 'DR303');


update department
set dept_head_init = 'AKr'
where dept_init = 'GenM';

update department
set dept_head_init = 'SsN'
where dept_init = 'MomC';

update department
set dept_head_init = 'DvS'
where dept_init = 'Srgr';

update department
set dept_head_init = 'HRd'
where dept_init = 'Emrg';

update department
set dept_head_init = 'OKr'
where dept_init = 'Dgns';


insert into purpose values
    ('P01', 'Psychiatry', 'GenM'),
    ('P02', 'ENT, Head & Neck', 'GenM'),
    ('P03', 'Cardiology', 'GenM'),
    ('P04', 'Consultancy & Medicine', 'GenM'),
    ('P05', 'Gynecology', 'MomC'),
    ('P06', 'Pediatrics', 'MomC'),
    ('P07', 'Treatment 24/7', 'Emrg'),
    ('P08', 'Skin & Burn', 'Srgr'),
    ('P09', 'Orthopaedics', 'Srgr'),
    ('P10', 'Cardiac & Vascular', 'Srgr'),
    ('P11', 'General Surgery', 'Srgr'),
    ('P12', 'Dialysis', 'Dgns'),
    ('P13', 'Pathology', 'Dgns');
    
insert into charge_sheet values
    ('CN01', 'Consultancy Fee', '800'),
    ('CN02', 'Bed Charge (Room)', '1650'),
    ('CN03', 'Service Charge (Room)', '320'),
    ('CN04', 'Dialysis', '3500'),
    ('CN05', 'Blood Bill', '880'),
    ('CN06', 'X-Ray', '1200'),
    ('CN07', 'ECG', '1650'),
    ('CN08', 'General Test 01', '500'),
    ('CN09', 'General Test 02', '800'),
    ('CN10', 'General Test 03', '1000'),
    ('CN11', 'General Test 04', '1500'),
    ('CN12', 'Surgery - Level 01', '5500'),
    ('CN13', 'Surgery - Level 02', '8500'),
    ('CN14', 'Surgery - Level 03', '15000'),
    ('CN15', 'Surgery - Level 04', '18000'),
    ('CN16', 'Emergency Service Fee', '600'),
    ('CN17', 'Emergency Consultancy Fee', '1200'),
    ('CN18', 'Others', NULL);
    
    
insert into payment_history values
    ('1', '1001', 'P01', '5720', '5720', '2018-04-20', '2018-04-22', 'NiS2', NULL, 0),
    ('1', '1002', 'P02', '8370', '2500', '2018-06-11', '2018-06-13', 'HsM', NULL, 0),
    ('1', '1003', 'P03', '4220', '2000', '2018-06-11', '2018-06-11', 'MKr', NULL, 0),
    ('1', '1004', 'P06', '1120', '1120', '2018-06-07', '2018-06-07', 'AbD', NULL, 0),
    ('1', '1006', 'P13', '7420', '7000', '2018-06-11', '2018-06-13', 'FZn', NULL, 0),
    ('1', '1008', 'P04', '1120', '1120', '2019-09-21', '2019-09-21', 'NHq', NULL, 0),
    ('1', '1009', 'P05', '1120', '1120', '2019-10-05', '2019-10-05', 'ACh', NULL, 0),
    ('1', '1015', 'P04', '10500', '10500', '2019-12-01', '2019-12-01', 'FzM', NULL, 0),
    ('1', '1017', 'P02', '6870', '6870', '2019-12-18', '2019-12-20', 'AKr', NULL, 0),
    ('1', '1018', 'P10', '9020', '6000', '2020-01-13', '2020-01-17', 'DvS', NULL, 0),
    ('1', '1013', 'P11', '13170', '13170', '2019-10-03', '2019-10-06', 'TrH', NULL, 0),
    ('1', '1014', 'P05', '7620', '7620', '2019-11-12', '2019-11-13', 'SsN', NULL, 0),
    ('1', '1019', 'P04', '1120', '1120', '2020-02-05', '2020-02-05', 'NHq', NULL, 0),
    ('2', '1013', 'P10', '43420', '2000', '2020-07-08', '2020-07-10', 'DvS', NULL, 0),
    ('1', '1020', 'P12', '8770', '7000', '2020-09-28', '2020-10-01', 'OKr', NULL, 0),
    ('1', '1021', 'P07', '8600', '3000', '2020-10-11', '2020-10-15', 'NiS', NULL, 0),
    ('2', '1014', 'P03', '6670', '5000', '2020-12-31', '2021-01-01', 'MKr', NULL, 0),
    ('1', '1022', 'P09', '32470', '25000', '2021-02-01', '2021-02-08', 'AhN', NULL, 0),
    ('1', '1023', 'P07', '2120', '2120', '2021-03-14', '2021-03-14', 'HRd', NULL, 0),
    ('1', '1026', 'P11', '10720', '10000', '2021-09-09', '2021-09-11', 'TrH', NULL, 0),
    ('1', '1027', 'P09', '24870', '2400', '2022-02-28', '2022-03-03', 'AhN', NULL, 0),
    ('1', '1028', 'P06', '14080', '14080', '2022-08-17', '2022-08-21', 'AbD', NULL, 0);
    
    
insert into patient_record values
    ('1', '1001', 'CN01', '1'),
    ('1', '1001', 'CN08', '1'),
    ('1', '1001', 'CN09', '1'),
    ('1', '1001', 'CN03', '1'),
    ('1', '1001', 'CN02', '2'),
    ('1', '1002', 'CN01', '2'),
    ('1', '1002', 'CN07', '1'),
    ('1', '1002', 'CN08', '1'),
    ('1', '1002', 'CN10', '1'),
    ('1', '1002', 'CN03', '1'),
    ('1', '1002', 'CN02', '2'),
    ('1', '1003', 'CN06', '2'),
    ('1', '1003', 'CN11', '1'),
    ('1', '1003', 'CN03', '1'),
    ('1', '1004', 'CN01', '1'),
    ('1', '1004', 'CN03', '1'),
    ('1', '1006', 'CN01', '1'),
    ('1', '1006', 'CN08', '2'),
    ('1', '1006', 'CN10', '2'),
    ('1', '1006', 'CN03', '1'),
    ('1', '1006', 'CN02', '2'),
    ('1', '1008', 'CN01', '1'),
    ('1', '1008', 'CN03', '1'),
    ('1', '1009', 'CN01', '1'),
    ('1', '1009', 'CN03', '1'),
    ('1', '1015', 'CN01', '3'),
    ('1', '1015', 'CN04', '1'),
    ('1', '1015', 'CN05', '1'),
    ('1', '1015', 'CN08', '2'),
    ('1', '1015', 'CN09', '3'),
    ('1', '1015', 'CN03', '1'),
    ('1', '1017', 'CN01', '2'),
    ('1', '1017', 'CN07', '1'),
    ('1', '1017', 'CN03', '1'),
    ('1', '1017', 'CN02', '2'),
    ('1', '1018', 'CN01', '2'),
    ('1', '1018', 'CN08', '1'),
    ('1', '1018', 'CN03', '1'),
    ('1', '1018', 'CN02', '4'),
    ('1', '1013', 'CN01', '1'),
    ('1', '1013', 'CN09', '2'),
    ('1', '1013', 'CN12', '1'),
    ('1', '1013', 'CN03', '1'),
    ('1', '1013', 'CN02', '3'),
    ('1', '1014', 'CN01', '2'),
    ('1', '1014', 'CN06', '2'),
    ('1', '1014', 'CN07', '1'),
    ('1', '1014', 'CN03', '1'),
    ('1', '1014', 'CN02', '1'),
    ('1', '1019', 'CN01', '1'),
    ('1', '1019', 'CN03', '1'),
    ('2', '1013', 'CN01', '3'),
    ('2', '1013', 'CN14', '1'),
    ('2', '1013', 'CN15', '1'),
    ('2', '1013', 'CN10', '2'),
    ('2', '1013', 'CN06', '2'),
    ('2', '1013', 'CN03', '1'),
    ('2', '1013', 'CN02', '2'),
    ('1', '1020', 'CN04', '1'),
    ('1', '1020', 'CN03', '1'),
    ('1', '1020', 'CN02', '3'),
    ('1', '1021', 'CN01', '1'),
    ('1', '1021', 'CN05', '1'),
    ('1', '1021', 'CN03', '1'),
    ('2', '1014', 'CN01', '2'),
    ('2', '1014', 'CN09', '2'),
    ('2', '1014', 'CN11', '1'),
    ('2', '1014', 'CN03', '1'),
    ('2', '1014', 'CN02', '1'),
    ('1', '1022', 'CN01', '2'),
    ('1', '1022', 'CN10', '1'),
    ('1', '1022', 'CN15', '1'),
    ('1', '1022', 'CN03', '1'),
    ('1', '1022', 'CN02', '7'),
    ('1', '1023', 'CN16', '1'),
    ('1', '1023', 'CN17', '1'),
    ('1', '1023', 'CN03', '1'),
    ('1', '1026', 'CN01', '2'),
    ('1', '1026', 'CN12', '1'),
    ('1', '1026', 'CN03', '1'),
    ('1', '1026', 'CN02', '2'),
    ('1', '1027', 'CN01', '2'),
    ('1', '1027', 'CN15', '1'),
    ('1', '1027', 'CN03', '1'),
    ('1', '1027', 'CN02', '3'),
    ('1', '1028', 'CN01', '3'),
    ('1', '1028', 'CN05', '2'),
    ('1', '1028', 'CN11', '2'),
    ('1', '1028', 'CN03', '1'),
    ('1', '1028', 'CN02', '4');


insert into panel values
    ('tanjir_ahmed', 'nadim123', 'Admin'),
    ('safayet_neyam', 'neyam123', 'User'),
    ('ahmed_nadim', 'tanjir123', 'User');
