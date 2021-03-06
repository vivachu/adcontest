DROP PROCEDURE if exists schedule_prize;

DELIMITER |

CREATE PROCEDURE schedule_prize(contestId int unsigned, prizePlace int unsigned, prizeName varchar(255), prizeValue decimal(10,2), numWinners int signed, description varchar(255), prizeImage varchar(255))
    BEGIN
    	DECLARE prizeId int unsigned;
    	DECLARE startDate datetime;
    	DECLARE endDate datetime;
    	DECLARE winDate datetime;
    	DECLARE i INT DEFAULT 0;

		WHILE (i<numWinners) DO
			select start_date, end_date, FROM_UNIXTIME(RAND() * (UNIX_TIMESTAMP(end_date) - UNIX_TIMESTAMP(start_date)) + UNIX_TIMESTAMP(start_date)) into startDate, endDate, winDate from contests where id = contestId;

			select id into prizeId from prizes where name=prizeName;

			IF isnull(prizeId) THEN
				insert into prizes(place, name, value, num_winners, description, image) values(prizePlace, prizeName, prizeValue, numWinners, description, prizeImage);
				select id into prizeId from prizes where name=prizeName;
			END IF;
			insert into prize_schedule(prize_id, contest_id, win_date) values (prizeId, contestId, winDate);
			SET i = i + 1;
		END WHILE;

    END;
|

DELIMITER ;