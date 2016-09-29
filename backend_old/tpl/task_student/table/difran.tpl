<a href="/gadmin/task_student/show_table?id={$smarty.get.id}">جدول دروس کاربر {showusername_name id=$smarty.get.id}</a> | <h1>ديفرانسيل</h1> <br /><br />

<style>
{literal}
.htover {}
.htover:hover{background: #CCCCCC; }

{/literal}
{$arr = [
['name'=>"دستگاه اعداد" ],
['name'=>"دنباله" ],
['name'=>"سري" ],
['name'=>"حد و پيوستگي و مجانب" ],
['name'=>"مشتق 1" ],
['name'=>"مشتق 2" ],
['name'=>"انتگرال" ],
['name'=>"تصاعد" ],
['name'=>"لگاريتم" ],
['name'=>"بخش پذيري" ],
['name'=>"تابع" ],
['name'=>"مثاثات" ],
['name'=>"معادله ي درجه 2" ],
['name'=>"آمار" ]
]} 

</style>
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
        
        {section name=dars start=1 loop=15 step=1}
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
