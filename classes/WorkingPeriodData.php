<?php


namespace EEV\Company\Classes;


class WorkingPeriodData
{

    public static function getDays($length = 'normal') {
        return [
            "Mo-Su" => trans("eev.company::lang.working_days.{$length}.MoSu"),
            "Mo-Fr" => trans("eev.company::lang.working_days.{$length}.MoFr"),
            "Mo" => trans("eev.company::lang.working_days.{$length}.Mo"),
            "Tu" => trans("eev.company::lang.working_days.{$length}.Tu"),
            "We" => trans("eev.company::lang.working_days.{$length}.We"),
            "Th" => trans("eev.company::lang.working_days.{$length}.Th"),
            "Fr" => trans("eev.company::lang.working_days.{$length}.Fr"),
            "Sa-Su" => trans("eev.company::lang.working_days.{$length}.SaSu"),
            "Sa" => trans("eev.company::lang.working_days.{$length}.Sa"),
            "Su" => trans("eev.company::lang.working_days.{$length}.Su"),
        ];
    }

}