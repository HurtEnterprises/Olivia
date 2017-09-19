//
// MHVObjective.m
// MHVLib
//
// Copyright (c) 2017 Microsoft Corporation. All rights reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
// http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//

/**
* NOTE: This class is auto generated by the swagger code generator program.
* https://github.com/swagger-api/swagger-codegen.git
* Do not edit the class manually.
*/


#import "MHVObjective.h"

@implementation MHVObjective

+ (BOOL)shouldValidateProperties
{
    return YES;
}

- (instancetype)init {
  self = [super init];
  if (self) {
    // initialize property's default value, if any
    
  }
  return self;
}



+ (NSDictionary *)propertyNameMap
{
    static dispatch_once_t once;
    static NSMutableDictionary *names = nil;
    dispatch_once(&once, ^{
        names = [[super propertyNameMap] mutableCopy];
        [names addEntriesFromDictionary:@{
            @"identifier": @"id",
            @"name": @"name",
            @"descriptionText": @"description",
            @"state": @"state",
            @"outcomeName": @"outcomeName",
            @"outcomeType": @"outcomeType"
        }];
    });
    return names;
}

+ (NSDictionary *)objectParametersMap
{
    static dispatch_once_t once;
    static NSMutableDictionary *types = nil;
    dispatch_once(&once, ^{
        types = [[super objectParametersMap] mutableCopy];
        [types addEntriesFromDictionary:@{
            @"state": [MHVObjectiveStateEnum class],
            @"outcomeType": [MHVObjectiveOutcomeTypeEnum class],

        }];
    });
    return types;
}
@end
@implementation MHVObjectiveStateEnum

-(NSDictionary *)enumMap
{
    return @{
        @"Unknown": @"Unknown",
        @"Inactive": @"Inactive",
        @"Active": @"Active",
    };
}

+(MHVObjectiveStateEnum *)MHVUnknown
{
    return [[MHVObjectiveStateEnum alloc] initWithString:@"Unknown"];
}
+(MHVObjectiveStateEnum *)MHVInactive
{
    return [[MHVObjectiveStateEnum alloc] initWithString:@"Inactive"];
}
+(MHVObjectiveStateEnum *)MHVActive
{
    return [[MHVObjectiveStateEnum alloc] initWithString:@"Active"];
}
@end
@implementation MHVObjectiveOutcomeTypeEnum

-(NSDictionary *)enumMap
{
    return @{
        @"Unknown": @"Unknown",
        @"StepsPerDay": @"StepsPerDay",
        @"CaloriesPerDay": @"CaloriesPerDay",
        @"ExerciseHoursPerWeek": @"ExerciseHoursPerWeek",
        @"SleepHoursPerNight": @"SleepHoursPerNight",
        @"MinutesToFallAsleepPerNight": @"MinutesToFallAsleepPerNight",
        @"Other": @"Other",
    };
}

+(MHVObjectiveOutcomeTypeEnum *)MHVUnknown
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"Unknown"];
}
+(MHVObjectiveOutcomeTypeEnum *)MHVStepsPerDay
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"StepsPerDay"];
}
+(MHVObjectiveOutcomeTypeEnum *)MHVCaloriesPerDay
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"CaloriesPerDay"];
}
+(MHVObjectiveOutcomeTypeEnum *)MHVExerciseHoursPerWeek
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"ExerciseHoursPerWeek"];
}
+(MHVObjectiveOutcomeTypeEnum *)MHVSleepHoursPerNight
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"SleepHoursPerNight"];
}
+(MHVObjectiveOutcomeTypeEnum *)MHVMinutesToFallAsleepPerNight
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"MinutesToFallAsleepPerNight"];
}
+(MHVObjectiveOutcomeTypeEnum *)MHVOther
{
    return [[MHVObjectiveOutcomeTypeEnum alloc] initWithString:@"Other"];
}
@end
