https://github.com/zircote/swagger-php/blob/master/Examples/using-refs/api-spec.php

// 合并数据: allOf
// 引用数据: ref="#/components/schemas/response_schema"
<<<str
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  schema="UpdateItem",
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/response_schema"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", ref="#/components/schemas/response_schema")
     *                      )
     *                  }
     *              )
     *          ),
     *      ),
str;