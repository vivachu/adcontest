DROP PROCEDURE if exists schedule_prize;

DELIMITER |

CREATE PROCEDURE schedule_prize(contestId, prizePlace, prizeName, prizeValue, numWinners)
    BEGIN
    	DECLARE prizeId int unsigned null;
    	DECLARE startDate date null;
    	DECLARE endDate date null;
    	DECLARE winDate date null;

    	select id, start_date, end_date into prizeId, startDate, endDate where name = prizeName;

    	IF isnull(prizeId) THEN
			insert into prizes(place, name, value, num_winners) values(prizePlace, prizeName, prizeValue, numWinners);
	    	select id, start_date, end_date into prizeId, startDate, endDate where name = prizeName;
    	END IF;

		select FROM_UNIXTIME(RAND() * (UNIX_TIMESTAMP(endDate) – UNIX_TIMESTAMP(startDate)) + UNIX_TIMESTAMP(startDate)) into winDate;

		insert into prize_schedule(prize_id, contest_id, win_date) values (prizeId, contestId, winDate);
    END;
|

DELIMITER ;
