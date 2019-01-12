<?php

namespace app\views\helpers;

use yii\helpers\Html;

/**
 * Description of StarsRating
 *
 * @author Hristo
 */
class HtmlStarsRating
{
    public static function starsRating($rating)
    {
        $rating = round($rating, 2);
        $rating > 5 ? $rating = 5 : false;
        $rating <= 0 ? $rating = 0 : false;
        $ratingPercentage = round($rating / 5 * 100, 1);
        // https://codepen.io/filcp/pen/QvZVOg
        $htmlStars = 
            '<div class="star-rating" title="100%">'.PHP_EOL;
        $htmlStars .= '
                <div class="back-stars">
                    <i id="back_star1" class="fa fa-star" aria-hidden="true"></i>
                    <i id="back_star2" class="fa fa-star" aria-hidden="true"></i>
                    <i id="back_star3" class="fa fa-star" aria-hidden="true"></i>
                    <i id="back_star4" class="fa fa-star" aria-hidden="true"></i>
                    <i id="back_star5" class="fa fa-star" aria-hidden="true"></i>

                    <div class="front-stars" style="width: '.$ratingPercentage.'%">
                        <i id="front_star1" class="fa fa-star" aria-hidden="true"></i>
                        <i id="front_star2" class="fa fa-star" aria-hidden="true"></i>
                        <i id="front_star3" class="fa fa-star" aria-hidden="true"></i>
                        <i id="front_star4" class="fa fa-star" aria-hidden="true"></i>
                        <i id="front_star5" class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>';
        return $htmlStars;
    }
    
    public static function starsRatingVote($blog_post_id)
    {
        $minRating = 1;
        $minRatingPercentage = $minRating * 20;
        $idPrefix = 'vote';
        strlen($idPrefix) > 0 ? $idPrefix .= '_' : false;
        // https://codepen.io/filcp/pen/QvZVOg
        $htmlStars = 
            '<div class="star-rating-vote" title="100%">
                <div class="back-stars">
                    <i id="'.$idPrefix.'back_star1" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star2" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star3" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star4" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star5" class="fa fa-star" aria-hidden="true"></i>
                    <div class="front-stars" style="width: '.$minRatingPercentage.'%">'.PHP_EOL;
        $url = ['/blog/postrating/vote', 'blog_post_id' => (int)$blog_post_id, 'rating' => $minRating,];
        $options = ['title' => \Yii::t('app', 'Vote with '.$url['rating'].' star'), 'data-pjax' => '1'];
        $htmlStars .= Html::a('<i id="'.$idPrefix.'front_star1" class="fa fa-star" aria-hidden="true"></i>', $url, $options).PHP_EOL;
        $url['rating'] = 2;
        $options['title'] = \Yii::t('app', 'Vote with '.$url['rating'].' stars');
        $htmlStars .= Html::a('<i id="'.$idPrefix.'front_star2" class="fa fa-star" aria-hidden="true"></i>', $url, $options).PHP_EOL;
        $url['rating'] = 3;
        $options['title'] = \Yii::t('app', 'Vote with '.$url['rating'].' stars');
        $htmlStars .= Html::a('<i id="'.$idPrefix.'front_star3" class="fa fa-star" aria-hidden="true"></i>', $url, $options).PHP_EOL;
        $url['rating'] = 4;
        $options['title'] = \Yii::t('app', 'Vote with '.$url['rating'].' stars');
        $htmlStars .= Html::a('<i id="'.$idPrefix.'front_star4" class="fa fa-star" aria-hidden="true"></i>', $url, $options).PHP_EOL;
        $url['rating'] = 5;
        $options['title'] = \Yii::t('app', 'Vote with '.$url['rating'].' stars');
        $htmlStars .= Html::a('<i id="'.$idPrefix.'front_star5" class="fa fa-star" aria-hidden="true"></i>', $url, $options).PHP_EOL;
        $htmlStars .= '</div>
                </div>
            </div>';
        return $htmlStars;
    }
}
