<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Panel;
use App\Models\Employee;

class PanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [
            'sets' => [
                'Number of reference sets dedicated to User' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-6&theme=light',
                'Indicators Type Distribution' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-2&theme=light',
                'Active Reference Sets' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-5&theme=light',
                'Total Indicators in System' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-3&theme=light',
                'Infrastructure Timeline (Creation Date vs Number of Elements)' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-4&theme=light',
                'Top Reference Sets by Volume' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-1&theme=light',
                'Active Retention Policies'=> 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&from=1774490966747&to=1774512566747&timezone=browser&theme=dark&panelId=panel-10&__feature.dashboardSceneSolo=true',
                'inActive Retention Policies'=>'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&from=1774490966747&to=1774512566747&timezone=browser&theme=dark&panelId=panel-11&__feature.dashboardSceneSolo=true',
                'Down Sources'=>'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&from=1774490966747&to=1774512566747&timezone=browser&theme=dark&panelId=panel-14&__feature.dashboardSceneSolo=true',
                'Total Assets' => 'http://192.168.1.24/opensearch/app/visualize#/edit/7d00adb0-2c23-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:Assets),schema:metric,type:count)),params:(addLegend:!t,addTooltip:!t,gauge:(alignment:automatic,backStyle:Full,colorSchema:\'Green%20to%20Red\',colorsRange:!((from:0,to:50),(from:50,to:75),(from:75,to:100)),extendRange:!t,gaugeColorMode:Labels,gaugeStyle:Full,gaugeType:Arc,invertColors:!f,labels:(color:black,show:!t),orientation:vertical,percentageMode:!f,scale:(color:\'rgba(105,112,125,0.2)\',labels:!f,show:!t),style:(bgColor:!t,bgFill:\'rgba(105,112,125,0.2)\',bgMask:!f,bgWidth:0.9,fontSize:60,mask:!f,maskBars:50,subText:\'\',width:0.9),type:meter),isDisplayWarning:!f,type:gauge),title:\'ToTal assets\',type:gauge))',
                'Infrastructure Timeline' => 'http://192.168.1.24/opensearch/app/visualize#/edit/b2dbe4c0-2c2a-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Sum%20Of%20Elements\',field:number_of_elements),schema:metric,type:sum),(enabled:!t,id:\'2\',params:(drop_partials:!f,extended_bounds:(),field:creation_time,interval:d,min_doc_count:1,scaleMetricValues:!f,timeRange:(from:now-15m,to:now),useNormalizedOpenSearchInterval:!t),schema:segment,type:date_histogram)),params:(addLegend:!t,addTimeMarker:!f,addTooltip:!t,categoryAxes:!((id:CategoryAxis-1,labels:(filter:!t,show:!t,truncate:100),position:bottom,scale:(type:linear),show:!t,style:(),title:(),type:category)),grid:(categoryLines:!f),labels:(),legendPosition:right,seriesParams:!((data:(id:\'1\',label:\'Sum%20Of%20Elements\'),drawLinesBetweenPoints:!t,interpolate:cardinal,lineWidth:2,mode:normal,show:!t,showCircles:!t,type:line,valueAxis:ValueAxis-1)),thresholdLine:(color:%23E7664C,show:!f,style:full,value:10,width:1),times:!(),type:area,valueAxes:!((id:ValueAxis-1,labels:(filter:!f,rotate:0,show:!t,truncate:100),name:LeftAxis-1,position:left,scale:(mode:normal,type:linear),show:!t,style:(),title:(text:\'Sum%20Of%20Elements\'),type:value))),title:\'Infrastructure Timeline\',type:area))',
                'Indicators Type Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/0436eb80-2c2b-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:element_type,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:5),schema:segment,type:terms)),params:(addLegend:!t,addTooltip:!t,isDonut:!t,labels:(last_level:!t,show:!t,truncate:100,values:!t),legendPosition:right,type:pie),title:\'Indicators Type Distributions\',type:pie))',
                'Active Reference Sets' => 'http://192.168.1.24/opensearch/app/visualize#/edit/6dbd1480-2c2b-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'2\',params:(customLabel:\'Active%20Reference%20Sets\',field:set_name),schema:metric,type:cardinality)),params:(addLegend:!f,addTooltip:!t,metric:(colorSchema:\'Green%20to%20Red\',colorsRange:!((from:0,to:10000)),invertColors:!f,labels:(show:!t),metricColorMode:None,percentageMode:!f,style:(bgColor:!f,bgFill:%23000,fontSize:60,labelColor:!f,subText:\'\'),useRanges:!f),type:metric),title:\'Total Active Reference Sets\',type:metric))',
                'Empty Sets Monitor' => 'http://192.168.1.24/opensearch/app/visualize#/edit/06ba1e80-2c2c-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'number_of_elements%20:%200\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Warning: Empty Reference Sets\'),schema:metric,type:count)),params:(addLegend:!f,addTooltip:!t,metric:(colorSchema:\'Green%20to%20Red\',colorsRange:!((from:0,to:10000)),invertColors:!f,labels:(show:!t),metricColorMode:None,percentageMode:!f,style:(bgColor:!f,bgFill:%23000,fontSize:60,labelColor:!f,subText:\'\'),useRanges:!f),type:metric),title:\'Empty Sets Monitor\',type:metric))',
                'Heatmap: Sets vs Volume' => 'http://192.168.1.24/opensearch/app/visualize#/edit/6d4aae30-2c2c-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:set_name,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:5),schema:segment,type:terms),(enabled:!t,id:\'3\',params:(field:element_type,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:5),schema:group,type:terms)),params:(addLegend:!t,addTooltip:!t,colorSchema:Greens,colorsNumber:4,legendPosition:right,type:heatmap)),title:\'Heatmap: Sets vs Volume\',type:heatmap))',
                'Data Growth Velocity' => 'http://192.168.1.24/opensearch/app/visualize#/edit/51ef21a0-2c2e-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(field:number_of_elements),schema:metric,type:max)),params:(type:gauge)),title:\'Data Growth Velocity\',type:goal))',
                'Reference Sets Usage Gauge' => 'http://192.168.1.24/opensearch/app/visualize#/edit/d8dba5e0-2c2d-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(field:number_of_elements),schema:metric,type:avg)),params:(type:metric)),title:\'Reference Sets Usage Gauge\',type:metric))',
                'Reference Sets Table' => 'http://192.168.1.24/opensearch/app/visualize#/edit/63099ab0-2c47-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count)),params:(type:table)),title:\'Reference Sets Table\',type:table))',
            ],

            'event' => [
                'Total Sources' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-2',
                'Last Recorded Activity' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-5',
                'Overall Risk Level' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-6',
                'Breakdown by Owner' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-3',
                'Total Sources per Level' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-1',
                'the latest time-based sources' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-7',
                'Security Devices Breakdown' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-4',
                
            ],

            'rules' => [
                'Disabled Security Rules' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=2',
                'Total Admin Rules' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=3',
                'Security Offenses Count' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=6',
                'Active Security Rules' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=1',
                'Rules Status Overview' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=10',
                'Rule Analysis (Distinct vs Total)' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=9',
                'Rules Creation Timeline' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=7',
                'Total Rules per Type' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=4',
                'Metric Total Alerts' => 'http://192.168.1.24/opensearch/app/visualize#/edit/a6652bc0-22b1-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Owner Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/5114d220-22b5-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'QRadar Rules - Status and Type Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/67ba4c90-21f6-11f1-9bf0-b364c70f9851?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Timeline of Events' => 'http://192.168.1.24/opensearch/app/visualize#/edit/0c0d2170-22b8-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Daily Alerts' => 'http://192.168.1.24/opensearch/app/visualize#/edit/fb3d5f70-22be-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Top Categories' => 'http://192.168.1.24/opensearch/app/visualize#/edit/745d68e0-22c0-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Origin Pie' => 'http://192.168.1.24/opensearch/app/visualize#/edit/c60f73d0-22c1-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Niveau de Risque' => 'http://192.168.1.24/opensearch/app/visualize#/edit/21dfde50-22c4-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Évolution des Menaces par Type' => 'http://192.168.1.24/opensearch/app/visualize#/edit/e9a866c0-22c7-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
            ],

            'saved-search' => [
                'System Searches' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=4',
                'Total Search Groups' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=2',
                'Admin-Created Searches' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=3',
                'System Load Status' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=8',
                'Groups Volume per Level' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=5',
                'Search Creation Timeline' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=6',
                'Owner-Level Correlation' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=7',
                'System vs Admin Searches' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=1',
                'Retention Periods by Bucket'=>'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&from=1774490966747&to=1774512566747&timezone=browser&theme=dark&panelId=panel-12&__feature.dashboardSceneSolo=true',
                'Most Frequent Offenses'=>'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&from=1774490966747&to=1774512566747&timezone=browser&theme=dark&panelId=panel-15&__feature.dashboardSceneSolo=true',
                'Total Offenses Count'=>'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&from=1774490966747&to=1774512566747&timezone=browser&theme=dark&panelId=panel-16&__feature.dashboardSceneSolo=true',
                'Total Ariel Searches' => 'http://192.168.1.24/opensearch/app/visualize#/edit/ffbf9450-2831-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Ariel Inventory: Events vs Flows' => 'http://192.168.1.24/opensearch/app/visualize#/edit/2e11e7f0-2831-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Search Visibility & Collaboration' => 'http://192.168.1.24/opensearch/app/visualize#/edit/b6e816f0-2834-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Top Search Keywords (Threat Focus)' => 'http://192.168.1.24/opensearch/app/visualize#/edit/9e94ddd0-2835-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Workload Distribution (Owner vs Source)' => 'http://192.168.1.24/opensearch/app/visualize#/edit/49c18e50-2837-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Search Accessibility Volume per Database' => 'http://192.168.1.24/opensearch/app/visualize#/edit/223bd530-284f-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Details Table' => 'http://192.168.1.24/opensearch/app/visualize#/edit/240ee750-282a-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Ariel Saved Searches Analytics' => 'http://192.168.1.24/opensearch/app/visualize#/edit/72969f40-2829-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Data Source Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/be058c30-282d-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Owner Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/7ba3c7d0-2828-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'SOC Search Library' => 'http://192.168.1.24/opensearch/app/visualize#/edit/08ad0610-2cf6-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(customLabel:\'Group Type\',field:is_system,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:5),schema:segment,type:terms)),params:(type:pie),title:\'SOC Search Library\',type:pie))',
                'Top Group Owners' => 'http://192.168.1.24/opensearch/app/visualize#/edit/b566dbb0-2cf6-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Number Of search\'),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:owner,size:5),schema:segment,type:terms)),params:(type:horizontal_bar),title:\'Top Group Owners\',type:horizontal_bar))',
                'Total Search Groups' => 'http://192.168.1.24/opensearch/app/visualize#/edit/1eeeb260-2cf7-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count)),params:(type:metric),title:\'Total Search group\',type:metric))',
                'Top Owners by Group Count' => 'http://192.168.1.24/opensearch/app/visualize#/edit/e7667780-2d03-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:owner,size:5),schema:segment,type:terms)),params:(type:pie),title:\'Top Owners by Group Count\',type:pie))',
                'Owner-to-Group Ownership Matrix' => 'http://192.168.1.24/opensearch/app/visualize#/edit/71ddb3b0-2d04-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:owner,size:5),schema:segment,type:terms),(enabled:!t,id:\'3\',params:(field:group_name,size:5),schema:group,type:terms)),params:(type:heatmap),title:\'Owner-to-Group Ownership Matrix\',type:heatmap))',
                'Documentation Health Check' => 'http://192.168.1.24/opensearch/app/visualize#/edit/a942a9f0-2d09-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Groups with Description\'),schema:metric,type:count)),params:(type:gauge),title:\'Documentation Health Check\',type:gauge))',
            ],

            'offenses' => [
                'Total Offenses' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=1',
                'Offenses Ouvertes (Actives)' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=3',
                'New Offenses Over Time' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=7',
                'Current Maximum Severity' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=5',
                'Top Offense Sources' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=4',
                'Most recent offenses' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=9',
                'Total Events' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=2',
                'Offense Severity Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/10adfc60-2c11-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Offenses Over Time' => 'http://192.168.1.24/opensearch/app/visualize#/edit/82eefd50-2c12-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Max Severity' => 'http://192.168.1.24/opensearch/app/visualize#/edit/797ad590-2c13-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Total Offenses Detected' => 'http://192.168.1.24/opensearch/app/visualize#/edit/98ec74b0-2c13-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Top Offense Sources' => 'http://192.168.1.24/opensearch/app/visualize#/edit/1234bc10-2c14-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Répartition Chronologique de la Sévérité' => 'http://192.168.1.24/opensearch/app/visualize#/edit/38af1650-2c15-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Offense Magnitude vs Severity' => 'http://192.168.1.24/opensearch/app/visualize#/edit/8ce2d830-2c18-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
                'Status Summary Table' => 'http://192.168.1.24/opensearch/app/visualize#/edit/ab824fb0-2c17-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))',
            ],

            'offenses-map' => [
                'Infractions ouvertes' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=4',
                'Importance critique' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=5',
                'Localisation IP' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=6',
                'Haute importance' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=7',
                'Threat Intelligence Map' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=1',
                'Inbound Network Attacks' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=3',
                'attack_path' => 'http://192.168.1.24/opensearch/app/dashboards#/view/8a54e0b0-2c20-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(description:\'\',filters:!(),fullScreenMode:!f,options:(hidePanelTitles:!f,useMargins:!t),query:(language:kuery,query:\'\'),timeRestore:!f,title:maps,viewMode:view)',
                'Global Threat Geolocation (Source Points)' => 'http://192.168.1.24/opensearch/app/visualize#/edit/8701f330-2851-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(mapCenter:!(17.392579271057766,14.677734375000002),mapZoom:2),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:Offenses),schema:metric,type:count),(enabled:!t,id:\'2\',params:(autoPrecision:!t,field:location,isFilteredByCollar:!t,precision:2,useGeocentroid:!t),schema:segment,type:geohash_grid)),params:(addTooltip:!t,colorSchema:\'Yellow%20to%20Red\',heatClusterSize:1.6,isDesaturated:!t,legendPosition:bottomright,mapCenter:!(0,0),mapType:Heatmap,mapZoom:2,wms:(enabled:!f,options:(attribution:\'\',format:image%2Fpng,layers:\'\',styles:\'\',transparent:!t,version:\'\'),selectedTmsLayer:(attribution:\'%3Ca%20rel%3D%22noreferrer%20noopener%22%20href%3D%22https:%2F%2Fwww.openstreetmap.org%2Fcopyright%22%3EMap%20data%20%C2%A9%20OpenStreetMap%20contributors%3C%2Fa%3E\',id:road_map,maxZoom:14,minZoom:0,origin:elastic_maps_service),url:\'\')),title:\'Global Threat Geolocation (Source Points)\',type:tile_map))',
                'Global Threat Geolocation (Circle View)' => 'http://192.168.1.24/opensearch/app/visualize#/edit/1cd62fd0-285b-11f1-b593-1953c508639c?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(autoPrecision:!t,field:location,isFilteredByCollar:!t,precision:2,useGeocentroid:!t),schema:segment,type:geohash_grid)),params:(addTooltip:!t,colorSchema:\'Yellow%20to%20Red\',heatClusterSize:1.5,isDesaturated:!t,legendPosition:bottomright,mapCenter:!(0,0),mapType:\'Shaded%20Circle%20Markers\',mapZoom:2,wms:(enabled:!f,options:(attribution:\'\',format:image%2Fpng,layers:\'\',styles:\'\',transparent:!t,version:\'\'),selectedTmsLayer:(attribution:\'%3Ca%20rel%3D%22noreferrer%20noopener%22%20href%3D%22https:%2F%2Fwww.openstreetmap.org%2Fcopyright%22%3EMap%20data%20%C2%A9%20OpenStreetMap%20contributors%3C%2Fa%3E\',id:road_map,maxZoom:14,minZoom:0,origin:elastic_maps_service),url:\'\')),title:\'Global Threat Geolocation\',type:tile_map))',
            ],

            'offenses-types' => [
                'Total Flow Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-4&theme=light',
                'Total Event Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-3&theme=light',
                'Security Alert Taxonomy' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-5&theme=light',
                'Custom vs Standard Offenses' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-7&theme=light',
                'Total Offense Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-2&theme=light',
                'Offense Distribution by Data Source' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-6&theme=light',
                'Summary of Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-1&theme=light',
            ],

            'general-stats' => [
                'Total Admin entries' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-5&theme=light',
                'Reference Data Breakdown' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-4&theme=light',
                'Total Reference Entries' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-2&theme=light',
                'Admin Added' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-3&theme=light',
                'QRadar Reference Data Explorer' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-1&theme=light',
            ],

            'log-sources' => [
                'Total Incoming EPS' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-7&theme=light',
                'EPS Load per Collector' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-8&theme=light',
                'Down Sources' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-14&theme=light',
                'Total Ingestion (EPS)' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-13&theme=light',
                'Sources in Error' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-6&theme=light',
                'EPS Distribution per Collector' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-9&theme=light',
            ],

            'network-activity' => [
                'Total Unique Groups' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-5&theme=light',
                'Network GroupsTotal Networks Distribution' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-4&theme=light',
                'Detailed Network Assets' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-3&theme=light',
                'Network Groups Distribution' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-2&theme=light',
            ],

            'events-retention' => [
                'Retention Periods by Bucket' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-12&theme=light',
                'Active Retention Policies' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-10&theme=light',
                'inActive Retention Policies' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-11&theme=light',
                'Service Status Monitor' => 'http://192.168.1.24/opensearch/app/visualize#/edit/65855cd0-2e7b-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'status:%20%22RUNNING%22\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'App Running\'),schema:metric,type:count)),params:(type:metric),title:\'Service Status Monitor\',type:metric))',
                'Global Localization Status' => 'http://192.168.1.24/opensearch/app/visualize#/edit/824648f0-2e7d-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:Total),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:app_name.keyword,size:5),schema:segment,type:terms)),params:(type:histogram),title:\'Global Localization Status\',type:histogram))',
                'Total App' => 'http://192.168.1.24/opensearch/app/visualize#/edit/b6f2c830-2e7d-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Total app\'),schema:metric,type:count)),params:(type:metric),title:\'Total App\',type:metric))',
                'App Distribution' => 'http://192.168.1.24/opensearch/app/visualize#/edit/828f82c0-2e84-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:_id,size:5),schema:segment,type:terms)),params:(type:pie),title:\'App Distribution\',type:pie))',
            ],
                'arial-lookups' => [
                'Network Traffic DNA' => 'http://192.168.1.24/opensearch/app/visualize#/edit/cf0e7040-2db0-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'lookup_type%20:%20%22Flow%20Source%20Types%22\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:name.keyword,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:5),schema:segment,type:terms)),params:(addLegend:!t,addTooltip:!t,isDonut:!t,labels:(last_level:!t,show:!t,truncate:100,values:!t),legendPosition:right,type:pie),title:\'Network Traffic DNA\',type:pie))',
                'Firewall Action Insights' => 'http://192.168.1.24/opensearch/app/visualize#/edit/26d153b0-2db1-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'Network%20Traffic%20DNA\'),uiState:(vis:(colors:(Count:%23eb806a,Total:%23eb806a,Totatl:%23eb806a))),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:Total),schema:metric,type:count),(enabled:!t,id:\'2\',params:(customLabel:\'Name%20Of%20Firewall%20Event\',field:name.keyword,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:10),schema:segment,type:terms)),params:(addLegend:!t,addTooltip:!t,type:histogram),title:\'Firewall Action Insights\',type:horizontal_bar))',
                'Network Path Diversity' => 'http://192.168.1.24/opensearch/app/visualize#/edit/a8d6dca0-2db5-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'lookup_type%20:%20%22Traffic%20Path%22\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:name.keyword,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:10),schema:segment,type:terms)),params:(addLegend:!t,addTooltip:!t,type:pie),title:\'Network Path Diversity\',type:pie))',
                'AWS Traffic Rejections' => 'http://192.168.1.24/opensearch/app/visualize#/edit/8af2b820-2db1-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'lookup_type%20:%20%22AWS%20Action%22%20AND%20name%20:%20%22Reject%22\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Total Type\'),schema:metric,type:count)),params:(type:metric),title:\'AWS Traffic Rejections\',type:metric))',
                'Application Detection Accuracy' => 'http://192.168.1.24/opensearch/app/visualize#/edit/53f02f60-2dbb-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:\'Total lookup Type\'),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:name.keyword,missingBucket:!f,missingBucketLabel:Missing,order:desc,orderBy:\'1\',otherBucket:!f,otherBucketLabel:Other,size:10),schema:segment,type:terms)),params:(type:histogram),title:\'Application Detection Accuracy\',type:horizontal_bar))',
                'AWS Log Health Status' => 'http://192.168.1.24/opensearch/app/visualize#/edit/a5a786f0-2dbb-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'lookup_type%20:%20%22AWS%20Log%20Status%22\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:name.keyword,size:5),schema:segment,type:terms)),params:(type:heatmap),title:\'AWS Log Health Status\',type:heatmap))',
                'Lookup Distribution Over Time' => 'http://192.168.1.24/opensearch/app/visualize#/edit/1c3e9b90-2dbd-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(customLabel:Lookup),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:sync_timestamp,interval:h),schema:segment,type:date_histogram)),params:(type:histogram),title:\'Lookup Distribution by Group\',type:histogram))',
                'Max Lookup Value' => 'http://192.168.1.24/opensearch/app/visualize#/edit/52c9ecf0-2dbd-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(field:lookup_id),schema:metric,type:max)),params:(type:gauge),title:\'Max Lookup\',type:gauge))',
                'Action Breakdown by Category' => 'http://192.168.1.24/opensearch/app/visualize#/edit/52592f20-2dd0-11f1-bc65-cb7d8c3a7560?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15w,to:now))&_a=(filters:!(),linked:!f,query:(language:kuery,query:\'lookup_type%20:%20%22Action%22\'),uiState:(),vis:(aggs:!((enabled:!t,id:\'1\',params:(),schema:metric,type:count),(enabled:!t,id:\'2\',params:(field:name.keyword,size:10),schema:segment,type:terms)),params:(type:pie),title:\'Action Breakdown by Category\',type:pie))',
                ],        
        ];

       $users = Employee::all();

foreach ($users as $user) {
    $clientId = $user->client_id;

    foreach ($data as $module => $panels) {
        foreach ($panels as $name => $url) {
            Panel::updateOrCreate(
                [
                    'grafana_url' => $url,
                    'client_id'   => $clientId,
                ],
                [
                    'module'   => $module,
                    'category' => 'General',
                    'name'     => $name,
                    'active'   => true,
                ]
            );
        }
    }
}
    }
}