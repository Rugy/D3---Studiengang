<?php

class ModuleGroupOverview
{
    public $id;
    public $name;
    public $minECTS;
    public $maxECTS;

    function __construct($id, $name, $minECTS, $maxECTS){
        $this->id = $id;
        $this->name = $name;
        $this->minECTS = $minECTS;
        $this->maxECTS = $maxECTS;
    }
}

class ModuleGroupsDetails {

    public $id;
    public $name;
    public $description;
    public $minECTS;
    public $maxECTS;

    public $courses;

    function __construct($id, $name, $minECTS, $maxECTS){
        $this->id = $id;
        $this->name = $name;
        $this->minECTS = $minECTS;
        $this->maxECTS = $maxECTS;
    }

    function setDescription ($description){
        $this->description = $description;
    }

    function setCourses ($courses) {
        $this->courses = $courses;
    }

}

class Course {

    public $short_name;
    public $full_name;
    public $semester;
    public $ects;
	public $mandatory;

    function __construct($short_name, $full_name, $semester, $ects, $mandatory){
        $this->short_name = $short_name;
        $this->full_name = $full_name;
        $this->semester = $semester;
        $this->ects = $ects;
        $this->mandatory = $mandatory;
    }
}

function overviewModuleGroups() {

    $module_groups = [];
    $module_groups[] = new ModuleGroupOverview("A1", "Mathematische Grundlagen", 27, 27);
    $module_groups[] = new ModuleGroupOverview("A2", "Informatik", 42, 48);
    $module_groups[] = new ModuleGroupOverview("A3", "Angewandte Informatik", 36, 42);
    $module_groups[] = new ModuleGroupOverview("A4", "Anwendungsfächer", 27, 33);
    $module_groups[] = new ModuleGroupOverview("A5", "Kontextstudium", 6, 12);
    $module_groups[] = new ModuleGroupOverview("A6", "Seminare und Projekte", 18, 18);
    $module_groups[] = new ModuleGroupOverview("A7", "Bachelorarbeit", 12, 12);
    return $module_groups;

}

function a1_courses() {
    $courses = [];
    $courses[] = new Course("Mathe-B-01", "Mathematik für Wirtschaftswissenschaftler I", "WS, SS", 3, true);
    $courses[] = new Course("GdI-MfI-1", "Mathematik für Informatik 1", "WS", 6, true);
    $courses[] = new Course("KTR-MfI-2-B", "Mathematik für Informatik 2", "SS", 6, true);
    $courses[] = new Course("Stat-B-01", "Methoden der Statistik I", "WS, SS", 6, true);
    $courses[] = new Course("Stat-B-02", "Methoden der Statistik II", "WS, SS", 6, true);
    return $courses;
}

function a2_courses() {
    $courses = [];
    // mandatory
    $courses[] = new Course("MI-AuD-B", "Algorithmen und Datenstrukturen", "SS", 6, true);
    $courses[] = new Course("GdI-GTI-B", "Grundlagen der Theoretischen Informatik", "SS", 6, true);
    $courses[] = new Course("DSG-EiAPS-B", "Einführung in Algorithmen, Programmierung und Software", "WS", 6, true);
    $courses[] = new Course("DSG-EiRBS-B", "Einführung in Rechner- und Betriebssysteme", "SS", 6, true);
    $courses[] = new Course("SWT-FSE-B", "Foundations of Software Engineering", "SS", 6, true);
    // optional
    $courses[] = new Course("KTR-Datkomm-B", "Datenkommunikation", "WS", 6, false);
    $courses[] = new Course("DSG-PKS-B", "Programmierung komplexer interagierender Systeme", "WS", 3, false);
    $courses[] = new Course("DSG-AJP-B", "Fortgeschrittene Java-Programmierung", "SS", 3, false);
    $courses[] = new Course("GdI-SaV-B", "Logik (Specification and Verification)", "WS", 6, false);
    $courses[] = new Course("GdI-NPP-B", "Nichtprozedurale Programmierung", "WS", 6, false);
    $courses[] = new Course("MOBI-IMP-B", "Implementation of Data Management Systems", "WS", 6, false);
    $courses[] = new Course("MOBI-MSS-B", "Mobility in Software Systems", "WS", 6, false);
    $courses[] = new Course("SEDA-DMS-B", "Datenmanagementsysteme", "SS", 6, false);
    return $courses;
}

function a3_courses() {
    $courses = [];
    // mandatory
    $courses[] = new Course("AI-EinfAI-B", "Einführung in die Angewandte Informatik", "WS, SS", 6, true);
    // optional
    $courses[] = new Course("KogSys-IA-B", "Intelligente Agenten", "SS", 6, false);
    $courses[] = new Course("KInf-GeoInf-B", "Geoinformationssysteme", "SS", 6, false);
    $courses[] = new Course("KInf-DigBib-B", "Digitale Bibliotheken und Social Computing", "WS", 6, false);
    $courses[] = new Course("MI-EMI-B", "Einführung in die Medieninformatik", "WS", 6, false);
    $courses[] = new Course("MI-WebT-B", "Web-Technologien", "SS", 6, false);
    $courses[] = new Course("HCI-IS-B", "Interaktive Systeme", "WS", 6, false);
    $courses[] = new Course("HCI-KS-B", "Kooperative Systeme", "SS", 6, false);
    $courses[] = new Course("HCI-US", "Ubiquitäre Systeme", "WS", 6, false);
    $courses[] = new Course("SME-Phy-B", "Physical Computing", "SS", 6, false);
    $courses[] = new Course("EESYS-GEI-B", "Grundlagen der Energieinformatik", "WS", 6, false);
    return $courses;
}

function a4_courses() {
    $courses = [];
    return $courses;
}

function a5_courses() {
    $courses = [];
    // optional
    $courses[] = new Course("HCI-DISTP-B", "Design Interaktiver Systeme: Theorie und Praxis", "SS", 3, false);
    $courses[] = new Course("EESYS-IITP-B", "Internationales IT-Projektmanagement", "SS", 6, false);
    $courses[] = new Course("SEDA-EuU-B", "Entrepreneurship und Unternehmensgründung", "SS", 3, false);
    $courses[] = new Course("SWT-SSP-B", "Softskills in IT-Projekten", "SS", 3, false);
    $courses[] = new Course("SEDA-PT-B", "Methoden der Präsentation, Gesprächsführung und Diskussion", "WS, SS", 3, false);

    $courses[] = new Course("ISDL-WAWI-B", "Wissenschaftliches Arbeiten in der Wirtschaftsinformatik", "WS", 3, false);
    $courses[] = new Course("SEDA-TA-B", "Technikfolgenabschätzung/-bewertung", "SS", 3, false);
    return $courses;
}

function a6_courses() {
    $courses = [];
    // mandatory
    $courses[] = new Course("AI-Sem1-B", "Bachelorseminar 1 der Fächergruppen Angewandte Informatik und Informatik", "WS, SS", 3, true);
    $courses[] = new Course("AI-Sem2-B", "Bachelorseminar 2 der Fächergruppen Angewandte Informatik und Informatik", "WS, SS", 3, true);
    // optional
    $courses[] = new Course("DSG-Project-B", "Bachelorprojekt zur Praktischen Informatik", "SS", 6, false);
    $courses[] = new Course("GdI-Proj-B", "Bachelorprojekt Grundlagen der Informatik", "WS, SS", 6, false);
    $courses[] = new Course("KTR-Proj", "Projekt Kommunikationsnetze und -dienste", "WS", 6, false);
    $courses[] = new Course("SWT-PR1-B", "Bachelorprojekt Softwaretechnik und Programmiersprachen", "SS", 6, false);
    $courses[] = new Course("KogSys-Proj-B", "Bachelor-Projekt Kognitive Systeme", "WS, SS", 6, false);
    $courses[] = new Course("KInf-Projekt-B", " Bachelor Projekt Kulturinformatik", "WS", 6, false);
    $courses[] = new Course("MI-Proj-B", "Projekt zur Medieninformatik", "WS", 6, false);
    $courses[] = new Course("HCI-Proj-B", "Projekt Mensch-Computer-Interaktion", "WS", 6, false);
    return $courses;
}

function a7_courses() {
    $courses = [];
    return $courses;
}

$module_details = [];
// A1
$details = new ModuleGroupsDetails("A1", "Mathematische Grundlagen", 27, 27);
$details->setDescription("Die Module im Bereich Mathematische Grundlagen (A1) dienen dazu, das theoretische
und methodische Rüstzeug für das Studienfach zu vermitteln.");
$details->setCourses(a1_courses());
$module_details["A1"] = $details;
// A2
$details = new ModuleGroupsDetails("A2", "Informatik", 42, 48);
$details->setDescription("Durch die Module im Bereich Informatik (A2) wird klar ein Schwerpunkt auf die Praktische
Informatik und die Aneignung praktischer Kompetenzen in der Systementwicklung gelegt.");
$details->setCourses(a2_courses());
$module_details["A2"] = $details;
// A3
$details = new ModuleGroupsDetails("A3", "Angewandte Informatik", 30, 36);
$details->setDescription("Neben einer Pflichtvorlesung, welche die Studierenden in die Angewandte Informatik einführt, 
bestehen in dieser Modulgruppe umfangreiche Freiheitsgrade. Je nach Interessenschwerpunkt können Module in den Fächern
 Kognitive Systeme, Kulturinformatik, Medieninformatik, Mensch-Computer-Interaktion sowie Smart Environments belegt werden.");
$details->setCourses(a3_courses());
$module_details["A3"] = $details;
// A4
$details = new ModuleGroupsDetails("A4", "Anwendungsfächer", 27, 33);
$details->setDescription("Die Lehrveranstaltungen in den Anwendungsfächern (A4) sollen die Studierenden exemplarisch
an domänenspezifische Problemstellungen heranführen. Sie sollen Methoden
und Herangehensweisen von Anwendungsgebieten aufzeigen und deren Sichtweise verdeutlichen,
um so einen anwendungsbezogenen Blick auf die Veranstaltungen der Informatik
und der Angewandten Informatik zu erlauben. Die Module aus dem Bereich Anwendungsfächer
werden von anderen Fakultäten der Universität Bamberg angeboten. Üblicherweise
handelt es sich um Module, die auch von Studierenden anderer Studiengänge
in deren unteren Semestern gehört werden (z.B. von Geographen im ersten Semester).
Die Anwendungsfächer stellen somit für Sie nicht nur eine abzulegende Prüfungsleistung
dar, sondern sind auch eine optimale Gelegenheit, andere Fachkulturen und Studierende
anderer Fächer kennenzulernen. Nutzen Sie diese Gelegenheit, um Ihr Studium individuell
auf Ihre Interessen zuzuschneiden!");
$details->setCourses(a4_courses());
$module_details["A4"] = $details;
// A5
$details = new ModuleGroupsDetails("A5", "Kontextstudium", 6, 12);
$details->setDescription("Im Rahmen des Kontextstudiums können Fremdsprachenkenntnisse erworben werden, die für die 
spätere berufliche Tätigkeit der Absolventinnen und Absolventen aufgrund zunehmender internationaler Zusammenarbeit
 in vielen Tätigkeitsfeldern grundlegend sein können. Darüber hinaus sind Module aus den Bereichen Philosophie & Ethik,
  Allgemeine Schlüsselqualifikationen (z.B. Präsentations- oder Rhetorikschulungen) sowie Grundzüge wissenschaftlichen Arbeitens wählbar.");
$details->setCourses(a5_courses());
$module_details["A5"] = $details;
// A6
$details = new ModuleGroupsDetails("A6", "Seminare und Projekte", 18, 18);
$details->setDescription("In Modulgruppe A6 belegen die Studierenden Seminare und Projekte aus den Themenbereichen der 
Informatik und Angewandten Informatik und bereiten sich so auf mögliche berufliche Einsatzfelder vor.");
$details->setCourses(a6_courses());
$module_details["A6"] = $details;
// A7
$details = new ModuleGroupsDetails("A7", "Bachelorarbeit", 12, 12);
$details->setDescription("Mit der Bachelorarbeit soll der Nachweis erbracht werden, dass der Prüfungskandidat in
der Lage ist, ein gestelltes Thema aus dem Bereich der Angewandten Informatik oder
Informatik selbstständig mit wissenschaftlichen Methoden zu bearbeiten. Für die Bearbeitung
ist ein Zeitraum von 4 Monaten vorgesehen. Die Zulassung zur Bachelorarbeit
muss schriftlich beantragt werden. Die Bachelorarbeit kann frühestens ab 120 ECTSPunkten
(gesammelt in A1 bis A6) begonnen werden. Die Bachelorarbeit selbst geht mit
12 ECTS-Punkten in die Zeugnisnote ein.");
$details->setCourses(a7_courses());
$module_details["A7"] = $details;

























