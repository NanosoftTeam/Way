<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;

class Settings2Controller extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings_content = Settings::find(1);
        $settings_content_p = Settings::find(2);
        $settings_content_html = Settings::find(3);
        $settings_content_js = Settings::find(4);

        $lesson0 = Settings::find(5);
        $lesson1 = Settings::find(6);
        $lesson2 = Settings::find(7);
        $lesson3 = Settings::find(8);
        $lesson4 = Settings::find(9);
        $lesson5 = Settings::find(10);
        $lesson6 = Settings::find(11);
        $lesson7 = Settings::find(12);
        $lesson8 = Settings::find(13);
        $lesson9 = Settings::find(14);
        $lesson10 = Settings::find(15);

        $rutyna_rano = Settings::find(16);
        $rutyna_popoludnie = Settings::find(17);
        $rutyna_wieczor = Settings::find(18);

        $quote = Settings::find(19);

        return view('settings_edit', [
            'settings_content' => $settings_content->content,
            'settings_content_p' => $settings_content_p->content,
            'settings_content_html' => $settings_content_html->content,
            'settings_content_js' => $settings_content_js->content,
            'lesson0' => $lesson0,
            'lesson1' => $lesson1,
            'lesson2' => $lesson2,
            'lesson3' => $lesson3,
            'lesson4' => $lesson4,
            'lesson5' => $lesson5,
            'lesson6' => $lesson6,
            'lesson7' => $lesson7,
            'lesson8' => $lesson8,
            'lesson9' => $lesson9,
            'lesson10' => $lesson10,
            'rutyna_rano' => $rutyna_rano->content,
            'rutyna_popoludnie' => $rutyna_popoludnie->content,
            'rutyna_wieczor' => $rutyna_wieczor->content,
            'quote' => $quote->content,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings_content = Settings::find(1);
        $settings_content->content = $request->content;
        $settings_content->save();

        $settings_content_p = Settings::find(2);
        $settings_content_p->content = $request->content_p;
        $settings_content_p->save();

        $settings_content_html = Settings::find(3);
        $settings_content_html->content = $request->content_html;
        $settings_content_html->save();

        $settings_content_js = Settings::find(4);
        $settings_content_js->content = $request->content_js;
        $settings_content_js->save();

        $lesson0 = Settings::find(5);
        $lesson0->content2 = $request->lesson_0_start;
        $lesson0->content3 = $request->lesson_0_end;
        $lesson0->save();

        $lesson1 = Settings::find(6);
        $lesson1->content2 = $request->lesson_1_start;
        $lesson1->content3 = $request->lesson_1_end;
        $lesson1->save();

        $lesson2 = Settings::find(7);
        $lesson2->content2 = $request->lesson_2_start;
        $lesson2->content3 = $request->lesson_2_end;
        $lesson2->save();

        $lesson3 = Settings::find(8);
        $lesson3->content2 = $request->lesson_3_start;
        $lesson3->content3 = $request->lesson_3_end;
        $lesson3->save();

        $lesson4 = Settings::find(9);
        $lesson4->content2 = $request->lesson_4_start;
        $lesson4->content3 = $request->lesson_4_end;
        $lesson4->save();

        $lesson5 = Settings::find(10);
        $lesson5->content2 = $request->lesson_5_start;
        $lesson5->content3 = $request->lesson_5_end;
        $lesson5->save();

        $lesson6 = Settings::find(11);
        $lesson6->content2 = $request->lesson_6_start;
        $lesson6->content3 = $request->lesson_6_end;
        $lesson6->save();

        $lesson7 = Settings::find(12);
        $lesson7->content2 = $request->lesson_7_start;
        $lesson7->content3 = $request->lesson_7_end;
        $lesson7->save();

        $lesson8 = Settings::find(13);
        $lesson8->content2 = $request->lesson_8_start;
        $lesson8->content3 = $request->lesson_8_end;
        $lesson8->save();

        $lesson9 = Settings::find(14);
        $lesson9->content2 = $request->lesson_9_start;
        $lesson9->content3 = $request->lesson_9_end;
        $lesson9->save();

        $lesson10 = Settings::find(15);
        $lesson10->content2 = $request->lesson_10_start;
        $lesson10->content3 = $request->lesson_10_end;
        $lesson10->save();

        $rutyna_rano = Settings::find(16);
        $rutyna_rano->content = $request->rutyna_rano;
        $rutyna_rano->save();

        $rutyna_popoludnie = Settings::find(17);
        $rutyna_popoludnie->content = $request->rutyna_popoludnie;
        $rutyna_popoludnie->save();

        $rutyna_wieczor = Settings::find(18);
        $rutyna_wieczor->content = $request->rutyna_wieczor;
        $rutyna_wieczor->save();

        $quote = Settings::find(19);
        $quote->content = $request->quote;
        $quote->save();









        return redirect(route('settings2.edit'));
    }
}
