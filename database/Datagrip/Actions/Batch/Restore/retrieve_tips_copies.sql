insert into tipsmoto.tips (
                  match_start_time,
                  home_teams,
                  away_teams,
                  home_odds,
                  away_odds,
                  draw_odds,
                  predictions,
                  predictions_accuracy,
                  status,
                  winning_status,
                  created_at,
                  updated_at,
                  deleted_at)
select
       match_start_time,
       home_teams,
       away_teams,
       home_odds,
       away_odds,
       draw_odds,
       predictions,
       predictions_accuracy,
       status,
       winning_status,
       created_at,
       updated_at,
       deleted_at
from copy_db.copy_tips;