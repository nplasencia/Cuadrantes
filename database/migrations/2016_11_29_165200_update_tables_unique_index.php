<?php

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PairContract;
use Cuadrantes\Commons\PeriodContract;
use Cuadrantes\Commons\RouteContract;
use Cuadrantes\Commons\ServiceConditionContract;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\ServiceExcludedPeriodContract;
use Cuadrantes\Commons\ServiceGroupOrderContract;
use Cuadrantes\Commons\ServiceSubstituteContract;
use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Commons\TimetableContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablesUniqueIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table( TimetableContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'timetables_period_id_foreign' );
		    $table->dropForeign( 'timetables_route_id_foreign' );
		    $table->dropUnique( [
			    TimetableContract::ROUTE_ID,
			    TimetableContract::PERIOD_ID,
			    TimetableContract::TIME,
			    TimetableContract::PASS
		    ] );

		    $table->foreign( TimetableContract::ROUTE_ID )->references( RouteContract::ID )->on( RouteContract::TABLE_NAME )->onDelete( 'cascade' );
		    $table->foreign( TimetableContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );

		    $table->unique( [
			    TimetableContract::ROUTE_ID,
			    TimetableContract::PERIOD_ID,
			    TimetableContract::TIME,
			    TimetableContract::PASS,
			    TimetableContract::DELETED_AT
		    ] );
	    } );

	    Schema::table( ServiceContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'services_excluded_period_id_foreign' );
		    $table->dropForeign( 'services_period_id_foreign' );
		    $table->dropUnique( [ ServiceContract::PERIOD_ID, ServiceContract::TIME, ServiceContract::NUMBER ] );

		    $table->foreign( ServiceContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceContract::EXCLUDED_PERIOD_ID )->references( ServiceExcludedPeriodContract::ID )->on( ServiceExcludedPeriodContract::TABLE_NAME );

		    $table->unique( [
			    ServiceContract::PERIOD_ID,
			    ServiceContract::TIME,
			    ServiceContract::NUMBER,
			    ServiceContract::DELETED_AT
		    ] );
	    } );

	    Schema::table( ServiceTimetablesContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_timetables_service_id_foreign' );
		    $table->dropForeign( 'service_timetables_timetable_id_foreign' );
		    $table->dropUnique( [
			    ServiceTimetablesContract::SERVICE_ID,
			    ServiceTimetablesContract::TIMETABLE_ID
		    ] );

		    $table->foreign( ServiceTimetablesContract::SERVICE_ID )->references( ServiceContract::ID )->on( ServiceContract::TABLE_NAME );
		    $table->foreign( ServiceTimetablesContract::TIMETABLE_ID )->references( TimetableContract::ID )->on( TimetableContract::TABLE_NAME );

		    $table->unique( [
			    ServiceTimetablesContract::SERVICE_ID,
			    ServiceTimetablesContract::TIMETABLE_ID,
			    ServiceTimetablesContract::DELETED_AT
		    ] );
	    } );

	    Schema::table( PairContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'pairs_driver_id_foreign' );
		    $table->dropUnique( [ PairContract::PAIR_ID, PairContract::DRIVER_ID ] );

		    $table->foreign( PairContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [ PairContract::PAIR_ID, PairContract::DRIVER_ID, PairContract::DELETED_AT ] );

	    } );

	    Schema::table( ServiceConditionContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_conditions_driver_id_foreign' );
		    $table->dropForeign( 'service_conditions_period_id_foreign' );
		    $table->dropUnique( [
			    ServiceConditionContract::PERIOD_ID,
			    ServiceConditionContract::SERVICE_GROUP,
			    ServiceConditionContract::DRIVER_ID
		    ] );

		    $table->foreign( ServiceConditionContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceConditionContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [
			    ServiceConditionContract::PERIOD_ID,
			    ServiceConditionContract::SERVICE_GROUP,
			    ServiceConditionContract::DRIVER_ID,
			    ServiceConditionContract::DELETED_AT
		    ], 'service_conditions_unique' );
	    } );

	    Schema::table( ServiceSubstituteContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_substitutes_driver_id_foreign' );
		    $table->dropForeign( 'service_substitutes_period_id_foreign' );
		    $table->dropUnique( [
			    ServiceSubstituteContract::PERIOD_ID,
			    ServiceSubstituteContract::SERVICE_GROUP,
			    ServiceSubstituteContract::DRIVER_ID
		    ] );

		    $table->foreign( ServiceSubstituteContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceSubstituteContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [
			    ServiceSubstituteContract::PERIOD_ID,
			    ServiceSubstituteContract::SERVICE_GROUP,
			    ServiceSubstituteContract::DRIVER_ID,
			    ServiceSubstituteContract::DELETED_AT
		    ],'service_substitutes_unique' );
	    } );

	    Schema::table( ServiceGroupOrderContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_group_order_driver_id_foreign' );
		    $table->dropForeign( 'service_group_order_period_id_foreign' );
		    $table->dropForeign( 'service_group_order_service_id_foreign' );
		    $table->dropUnique( [
			    ServiceGroupOrderContract::DRIVER_ID,
			    ServiceGroupOrderContract::SERVICE_ID,
			    ServiceGroupOrderContract::NORMALIZED
		    ] );

		    $table->foreign( ServiceGroupOrderContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceGroupOrderContract::SERVICE_ID )->references( ServiceContract::ID )->on( ServiceContract::TABLE_NAME );
		    $table->foreign( ServiceGroupOrderContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [
			    ServiceGroupOrderContract::DRIVER_ID,
			    ServiceGroupOrderContract::SERVICE_ID,
			    ServiceGroupOrderContract::NORMALIZED,
			    ServiceGroupOrderContract::DELETED_AT
		    ], 'service_group_order_unique' );
	    } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table( TimetableContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'timetables_period_id_foreign' );
		    $table->dropForeign( 'timetables_route_id_foreign' );
		    $table->dropUnique( [
			    TimetableContract::ROUTE_ID,
			    TimetableContract::PERIOD_ID,
			    TimetableContract::TIME,
			    TimetableContract::PASS,
			    TimetableContract::DELETED_AT
		    ] );

		    $table->foreign( TimetableContract::ROUTE_ID )->references( RouteContract::ID )->on( RouteContract::TABLE_NAME )->onDelete( 'cascade' );
		    $table->foreign( TimetableContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );

		    $table->unique( [
			    TimetableContract::ROUTE_ID,
			    TimetableContract::PERIOD_ID,
			    TimetableContract::TIME,
			    TimetableContract::PASS
		    ] );
	    } );

	    Schema::table( ServiceContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'services_excluded_period_id_foreign' );
		    $table->dropForeign( 'services_period_id_foreign' );
		    $table->dropUnique( [
			    ServiceContract::PERIOD_ID,
			    ServiceContract::TIME,
			    ServiceContract::NUMBER,
			    ServiceContract::DELETED_AT
		    ] );

		    $table->foreign( ServiceContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceContract::EXCLUDED_PERIOD_ID )->references( ServiceExcludedPeriodContract::ID )->on( ServiceExcludedPeriodContract::TABLE_NAME );

		    $table->unique( [ ServiceContract::PERIOD_ID, ServiceContract::TIME, ServiceContract::NUMBER ] );
	    } );

	    Schema::table( ServiceTimetablesContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_timetables_service_id_foreign' );
		    $table->dropForeign( 'service_timetables_timetable_id_foreign' );
		    $table->dropUnique( [
			    ServiceTimetablesContract::SERVICE_ID,
			    ServiceTimetablesContract::TIMETABLE_ID,
			    ServiceTimetablesContract::DELETED_AT
		    ] );

		    $table->foreign( ServiceTimetablesContract::SERVICE_ID )->references( ServiceContract::ID )->on( ServiceContract::TABLE_NAME );
		    $table->foreign( ServiceTimetablesContract::TIMETABLE_ID )->references( TimetableContract::ID )->on( TimetableContract::TABLE_NAME );

		    $table->unique( [ ServiceTimetablesContract::SERVICE_ID, ServiceTimetablesContract::TIMETABLE_ID ] );
	    } );

	    Schema::table( PairContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'pairs_driver_id_foreign' );
		    $table->dropUnique( [ PairContract::PAIR_ID, PairContract::DRIVER_ID, PairContract::DELETED_AT ] );

		    $table->foreign( PairContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [ PairContract::PAIR_ID, PairContract::DRIVER_ID ] );
	    } );

	    Schema::table( ServiceConditionContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_conditions_driver_id_foreign' );
		    $table->dropForeign( 'service_conditions_period_id_foreign' );
		    $table->dropUnique( 'service_conditions_unique' );

		    $table->foreign( ServiceConditionContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceConditionContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [
			    ServiceConditionContract::PERIOD_ID,
			    ServiceConditionContract::SERVICE_GROUP,
			    ServiceConditionContract::DRIVER_ID
		    ] );
	    } );

	    Schema::table( ServiceSubstituteContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_substitutes_driver_id_foreign' );
		    $table->dropForeign( 'service_substitutes_period_id_foreign' );
		    $table->dropUnique( 'service_substitutes_unique' );

		    $table->foreign( ServiceSubstituteContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceSubstituteContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [
			    ServiceSubstituteContract::PERIOD_ID,
			    ServiceSubstituteContract::SERVICE_GROUP,
			    ServiceSubstituteContract::DRIVER_ID
		    ] );
	    } );

	    Schema::table( ServiceGroupOrderContract::TABLE_NAME, function ( Blueprint $table ) {
		    $table->dropForeign( 'service_group_order_driver_id_foreign' );
		    $table->dropForeign( 'service_group_order_period_id_foreign' );
		    $table->dropForeign( 'service_group_order_service_id_foreign' );
		    $table->dropUnique( 'service_group_order_unique' );

		    $table->foreign( ServiceGroupOrderContract::PERIOD_ID )->references( PeriodContract::ID )->on( PeriodContract::TABLE_NAME );
		    $table->foreign( ServiceGroupOrderContract::SERVICE_ID )->references( ServiceContract::ID )->on( ServiceContract::TABLE_NAME );
		    $table->foreign( ServiceGroupOrderContract::DRIVER_ID )->references( DriverContract::ID )->on( DriverContract::TABLE_NAME );

		    $table->unique( [
			    ServiceGroupOrderContract::DRIVER_ID,
			    ServiceGroupOrderContract::SERVICE_ID,
			    ServiceGroupOrderContract::NORMALIZED
		    ] );
	    } );
    }
}
