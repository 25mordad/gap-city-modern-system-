<a href="/gadmin/task_student/show_table?id={$smarty.get.id}">جدول دروس کاربر {showusername_name id=$smarty.get.id}</a> | <h1>فيزيک </h1> <br /><br />

<style>
{literal}
.htover {}
.htover:hover{background: #CCCCCC; }

{/literal}
</style>
{$arr = [
['name'=>"حرکت" ],
['name'=>"ديناميک " ],
['name'=>"نوسان" ],
['name'=>"موج 1" ],
['name'=>"موج 2" ],
['name'=>"الکترومغناطيس" ],
['name'=>"فيزيک اتمي" ],
['name'=>"فيزيک حالت جامد" ],
['name'=>"ترموديناميک" ],
['name'=>"الکتريسيته ساکن" ],
['name'=>"مدار و جريان " ],
['name'=>"مغناطيس" ],
['name'=>"القاي مغناطيس" ],
['name'=>"گرما" ],
['name'=>"ويژگي ماده" ],
['name'=>"کار و انرژي" ],
['name'=>"نورو بازتاب" ],
['name'=>"شکست و عدسي ها " ]
]} 
<table >
    <tbody>
        <tr>
            <td width="91" valign="top">
            <div dir="RTL"><b>ردیف</b></div>
            </td>
            <td width="91" valign="top">
            <div dir="RTL"><b>مطالعه1</b></div>
            </td>
            <td width="91" valign="top">
            <div dir="RTL"><b>مرور1</b></div>
            </td>
             <td width="91" valign="top">
            <div dir="RTL"><b>مرور2</b></div>
            </td>
            <td width="91" valign="top">
            <div dir="RTL"><b>تست1</b></div>
            </td>
            <td width="91" valign="top">
            <div dir="RTL"><b>تست2</b></div>
            </td>
            <td width="91" valign="top">
            <div dir="RTL"><b>جمع بندی</b></div>
            </td>
        </tr>
        {section name=dars start=1 loop=19 step=1}
           <tr class="htover">
                <td width="91" valign="top">
                <div dir="RTL"><b>{$arr[$smarty.section.dars.index-1]['name']}</b></div>
                </td>
                <td width="91" valign="top">
                
                <div dir="RTL">{find_task_student_table_admin id_student=$smarty.get.id  title_dars=$smarty.get.table part_no=$smarty.section.dars.index part_type="motale_1" }</div>
                </td>
                <td width="91" valign="top">
                <div dir="RTL">{find_task_student_table_admin id_student=$smarty.get.id  title_dars=$smarty.get.table part_no=$smarty.section.dars.index part_type="moror_1" }</div>
                </td>
                <td width="91" valign="top">
                <div dir="RTL">{find_task_student_table_admin id_student=$smarty.get.id  title_dars=$smarty.get.table part_no=$smarty.section.dars.index part_type="moror_2" }</div>
                </td>
                <td width="91" valign="top">
                <div dir="RTL">{find_task_student_table_admin id_student=$smarty.get.id  title_dars=$smarty.get.table part_no=$smarty.section.dars.index part_type="test_1" }</div>
                </td>
                <td width="91" valign="top">
                <div dir="RTL">{find_task_student_table_admin id_student=$smarty.get.id  title_dars=$smarty.get.table part_no=$smarty.section.dars.index part_type="test_2" }</div>
                </td>
                <td width="91" valign="top">
                <div dir="RTL">{find_task_student_table_admin id_student=$smarty.get.id  title_dars=$smarty.get.table part_no=$smarty.section.dars.index part_type="jambandi" }</div>
                </td>
            </tr>
        {/section}
        
        
    </tbody>
</table>